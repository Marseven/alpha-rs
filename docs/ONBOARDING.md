# Guide de prise en main — Relief Services (`alpha-rs`)

> Document d'onboarding pour un·e nouveau·elle développeur·euse. Objectif :
> être opérationnel·le en une demi-journée. Les informations propres à
> l'**hébergement** (serveur, domaine, identifiants BDD/SMTP, accès SSH) sont
> volontairement laissées **vides** — à compléter depuis le coffre de secrets.

---

## 1. En deux mots

**Relief Services** est une plateforme de **conciergerie médicale** et
d'**évacuation sanitaire** pour le Gabon : un patient fait une demande de devis,
l'équipe la traite, un médecin puis la CNAMGS analysent le dossier médical, et
le paiement des frais de service se fait en ligne.

L'application couvre **quatre espaces** :

| Espace | Public visé | Accès |
|---|---|---|
| **Public** | Visiteurs | Site vitrine, demande de devis, simulateur, suivi, assistant IA |
| **Client** | Patients connectés | Dossiers, devis, paiements, profil |
| **Médical** | Médecins & CNAMGS | Suivi et validation des dossiers médicaux assignés |
| **Admin** | Back-office | Gestion complète (devis, dossiers, paiements, contenus, RBAC, IA) |

---

## 2. Stack technique

| Couche | Technologie |
|---|---|
| Langage | **PHP 8.2+** |
| Framework | **Laravel 12** (structure classique `Http/Kernel.php`) |
| Vue | **Blade**, **Livewire 3**, **Alpine.js** (fourni par Livewire) |
| Auth | **Jetstream 5 / Fortify / Sanctum 4** |
| CSS / build | **Tailwind CSS 3.4** + **Vite 6** (⚠️ pas de jQuery/Bootstrap) |
| Tables | **simple-datatables** (recherche/tri/pagination, sans dépendance) |
| Image | **intervention/image 3** |
| Push / notif | **kreait/laravel-firebase** (FCM) |
| Paiement | **Singpay** + **E-Billing CGI** |
| IA | Endpoint **compatible OpenAI** (OpenAI / Groq / Gemini / OpenRouter) |
| Tests | **PHPUnit 11** (SQLite en mémoire) |

Ordres de grandeur du dépôt : ~30 contrôleurs, ~20 modèles, ~12 services,
29 migrations, 129 vues Blade, 39 fichiers de test.

---

## 3. Démarrage rapide

### Prérequis
- PHP **8.2** (sous MAMP : `/Applications/MAMP/bin/php/php8.2.x/bin/php`)
- Composer, Node 18+ / npm
- Une base MySQL/MariaDB (ou SQLite pour du local rapide)

### Installation
```bash
git clone https://github.com/Marseven/alpha-rs.git
cd alpha-rs

composer install
cp .env.example .env
php artisan key:generate
# → renseigner DB_* et les passerelles dans .env (voir §11)

php artisan migrate

npm install
npm run build          # ou `npm run dev` pour le hot-reload Vite
php artisan serve      # http://127.0.0.1:8000
```

### Créer des comptes de test
```bash
# promouvoir un compte existant en médecin / CNAMGS
php artisan users:set-role user@example.com doctor
php artisan users:set-role user@example.com cnamgs
```
Un compte **admin** se distingue par son `security_role_id` rattaché à l'objet
de sécurité `admin` (voir §8). Les comptes médicaux se distinguent par leur
colonne `workflow_role` (`doctor` / `cnamgs`).

---

## 4. Structure du projet

```
app/
  Http/
    Controllers/
      Admin/           # back-office (namespace Admin, middleware `admin`)
      Auth/            # login, register, reset, vérification e-mail
      Doctor/          # espace médecin  (middleware workflow_role:doctor)
      Cnamgs/          # espace CNAMGS   (middleware workflow_role:cnamgs)
      QuoteController, FolderController, PaymentController,
      SimulatorController, HospitalController, WelcomeController,
      AiAssistantController, FileController, TrackController…
    Kernel.php         # alias middleware : `admin`, `workflow_role`
  Models/              # Quote, Folder, Payment, MedicalCaseWorkflow, User…
  Policies/            # QuotePolicy, FolderPolicy, MedicalCaseWorkflowPolicy
  Services/
    Payments/          # SingpayGateway/Provider, EbillingProvider, interface
    QuoteNotifier.php          # fan-out des e-mails de devis
    SensitiveFileStorage.php   # stockage privé des documents
    Rbac.php                   # permissions fines du back-office
    AiAssistantService.php     # garde médicale + base de connaissances
  Console/Commands/    # commandes artisan maison (voir §12)
config/
  relief.php           # config métier : coordonnées, bureaux, SEO, IA
resources/
  css/app.css          # design system (tokens + overrides datatable)
  js/app.js            # init datatables, bootstrap Vite
  views/
    layouts/           # public, client, backoffice, medical, login, guest
    components/ui/      # button, card, badge, stat, alert…
    quote/ folder/ admin/ doctor/ cnamgs/ medical/ …
routes/web.php         # toutes les routes (groupées par espace)
database/migrations/   # 29 migrations (idempotentes, cf. §10)
docs/                  # documentation (ce fichier + ci-dessous)
deploy.sh              # script de déploiement git-pull
```

---

## 5. Espaces & rôles

Le type de compte détermine la redirection après connexion
(`Auth\LoginController::homeFor()`) :

| Rôle | Discriminant | Redirection |
|---|---|---|
| Admin | `security_role_id` → objet `admin` (middleware `admin`) | `/admin/dashboard` |
| Médecin | `workflow_role = 'doctor'` | `/doctor/cases` |
| CNAMGS | `workflow_role = 'cnamgs'` | `/cnamgs/cases` |
| Client | aucun des ci-dessus | `/profil` |

Les routes sont regroupées par espace dans `routes/web.php` :
- `Route::prefix('admin')->namespace('Admin')->middleware('admin')`
- `Route::middleware(['auth','workflow_role:doctor'])->prefix('doctor')`
- `Route::middleware(['auth','workflow_role:cnamgs'])->prefix('cnamgs')`
- `Route::middleware('auth')` pour l'espace client.

---

## 6. Domaines fonctionnels clés

- **Devis** (`Quote`) : demande publique avec pièces jointes → traitement admin
  (statut + import du devis PDF) → **le client reçoit son devis par e-mail** et
  le consulte dans son espace (`/quote/payment/{id}`, vue « Mon devis »).
  Statuts admin : Reçu / En cours / **Traité** (`STATUT_DO`).
- **Dossiers** (`Folder`) : suivi de la prise en charge, paiement, notifications.
- **Workflow médical** (`MedicalCaseWorkflow`) : un dossier est assigné à un
  **médecin** puis transmis à la **CNAMGS** (caisse d'assurance) pour validation.
  Historique des statuts (`MedicalCaseStatusHistory`), notifications
  (`CaseNotification`). Voir Policies `MedicalCaseWorkflowPolicy`.
- **Paiements** (`Payment`) : **Singpay** et **E-Billing CGI**. Webhooks
  **signés** (`PAYMENT_WEBHOOK_SECRET`) vérifiés par `PaymentWebhookVerifier`,
  plus une *inquiry* serveur-à-serveur. Montant résolu par `PaymentAmountResolver`.
- **Simulateur** (`Simulator`/`SimulatorItem`) : estimation de coûts.
- **Annuaire d'hôpitaux** (`Hospital`) + pathologies (`Sick`).
- **Assistant IA** (`AiAssistantService`) : chatbot gardé (le prompt hors sujet
  médical est refusé), **base de connaissances** éditable en admin
  (`AiKnowledgeEntry`, `Admin/KnowledgeController`) injectée dans le prompt.
- **Suivi public** (`TrackController`) : suivi d'un dossier par référence.

Détail fonctionnel complet : [`FEATURES.md`](FEATURES.md).

---

## 7. Design system

Tout le front récent est en **Tailwind** (pas de Bootstrap/jQuery).

- **Tokens** (`tailwind.config.js`) : `primary` (bleu #1568B8), `accent`
  (rouge, CTA uniquement), `success`/`warning`/`ink`/`line`/`canvas`.
- **Typos** : Poppins (`font-display`), Manrope (`font-sans`), JetBrains Mono
  (`font-mono`, étiquettes `.eyebrow`).
- **Composants** : `resources/views/components/ui/` (`x-ui.button`, `x-ui.card`,
  `x-ui.badge`, `x-ui.stat-card`, `x-ui.alert`…).
- **Layouts** : `layouts.public`, `layouts.client`, `layouts.backoffice`,
  `layouts.medical`, `layouts.login`.
- **Tables** : ajouter l'attribut `data-datatable` à un `<table>` suffit
  (init automatique dans `resources/js/app.js`).

Référence complète : [`DESIGN_SYSTEM.md`](DESIGN_SYSTEM.md).

---

## 8. Sécurité & contrôle d'accès

- **Documents sensibles** (passeports, rapports, examens, devis) : stockés sur
  le **disque privé** (`storage/app/private/...`) via `SensitiveFileStorage`,
  **jamais** sous `public/`. Téléchargement uniquement via une route
  authentifiée + Policy : `/files/quotes/{quote}/{field}` et
  `/files/folders/{folder}/{field}`.
- **Policies** (`QuotePolicy`, `FolderPolicy`, `MedicalCaseWorkflowPolicy`) :
  un client n'agit que sur ses propres ressources ; les actions médicales
  vérifient l'assignation et le statut.
- **RBAC back-office** (`Rbac` + tables `security_object` / `security_role` /
  `security_role_permission`) : dans un contrôleur admin, protéger une action
  avec `Controller::he_can('Objet', 'look|creat|updat|del')`. Règle *fail-safe* :
  un rôle configuré n'a accès qu'aux permissions explicitement à `on` ; un rôle
  sans permission configurée = accès complet (compat héritage).

Rotation des secrets et durcissement : [`../SECURITY.md`](../SECURITY.md) et
[`HARDENING_REPORT.md`](HARDENING_REPORT.md).

---

## 9. E-mails — envoi synchrone (pas de file d'attente)

⚠️ **Piège important.** Le projet **n'utilise pas de worker de queue**. Les
mailables sont envoyés **en ligne** via la connexion `sync`.

- Un nouveau mailable **ne doit pas** implémenter `ShouldQueue`.
- Ne pas ajouter `php artisan queue:work` au déploiement.
- Les appels existants `Mail::to()->queue(...)` s'exécutent immédiatement sous
  `QUEUE_CONNECTION=sync` — inutile de les convertir.
- `->queue()` sérialise le mailable (`SerializesModels` recharge les modèles par
  id) : le modèle doit être **persisté** avant la notification (c'est le cas
  dans les flux réels).

---

## 10. Base de données & migrations

- **29 migrations**, toutes **idempotentes / gardées**
  (`Schema::hasTable` / `hasColumn`) car la prod se déploie par `git pull` sans
  possibilité de rejouer proprement l'historique.
- En prod, la table `migrations` est désynchronisée : `deploy.sh` fait un
  **baseline** des anciennes migrations (< 2024) avant d'appliquer les récentes.
- Seeders utiles : `IsraelDestinationSeeder` (ajoute une destination).
- Snapshot SQL de référence : [`PROD_SQL_2024_05.sql`](PROD_SQL_2024_05.sql).

> Les statuts métier sont des **constantes globales** définies en tête de
> `app/Http/Controllers/Controller.php` : `STATUT_RECEIVE (0)`,
> `STATUT_PENDING (1)`, `STATUT_APPROVE (2)`, `STATUT_REFUSED (3)`,
> `STATUT_CANCEL (4)`, `STATUT_PAID (5)`, `STATUT_DO (6, « Traité »)`,
> `STATUT_ENABLE (7)`… En contexte hors requête (tests), utiliser
> `defined('STATUT_X') ? STATUT_X : <valeur>`.

---

## 11. Configuration (`.env`)

> Renseigner les valeurs depuis le coffre de secrets. **Ne jamais committer
> `.env`.** Les lignes d'hébergement sont laissées vides ci-dessous.

### Hébergement — *à compléter*
| Variable | Rôle | Valeur |
|---|---|---|
| `APP_URL` | URL publique | _(à renseigner)_ |
| `DB_HOST` / `DB_PORT` / `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` | Base de données | _(à renseigner)_ |
| `MAIL_HOST` / `MAIL_PORT` / `MAIL_USERNAME` / `MAIL_PASSWORD` / `MAIL_ENCRYPTION` | SMTP | _(à renseigner)_ |
| `MAIL_FROM_ADDRESS` / `MAIL_FROM_NAME` | Expéditeur | _(à renseigner)_ |
| `AWS_*` | Stockage S3 (optionnel) | _(à renseigner)_ |

### Application (non lié à l'hébergement)
| Variable | Rôle |
|---|---|
| `APP_ENV` / `APP_DEBUG` | `production` / `false` en prod |
| `QUEUE_CONNECTION` | **`sync`** (voir §9) |
| `SESSION_DRIVER` / `CACHE_DRIVER` | pilotes session / cache |

### Paiement
| Variable | Rôle |
|---|---|
| `SINGPAY_BASE_URL` / `SINGPAY_INQUIRY_URL` | Endpoints Singpay |
| `SINGPAY_CLIENT_ID` / `SINGPAY_CLIENT_SECRET` | Identifiants Singpay |
| `SINGPAY_WALLET_ID` / `SINGPAY_DISBURSEMENT_WALLET_ID` | Portefeuilles |
| `EBILLING_BASE_URL` / `EBILLING_INQUIRY_URL` / `EBILLING_POST_URL` | Endpoints E-Billing |
| `EBILLING_USERNAME` / `EBILLING_SHARED_KEY` | Identifiants E-Billing |
| `PAYMENT_WEBHOOK_SECRET` | Secret HMAC des webhooks |
| `QUOTE_PAYMENT_AMOUNT` | Montant des frais de service |
| `PAYMENT_REQUIRE_PROVIDER_INQUIRY` | Inquiry serveur obligatoire (bool) |

### Assistant IA
| Variable | Rôle |
|---|---|
| `AI_ASSISTANT_ENABLED` | Active le chatbot (bool) |
| `AI_PROVIDER` | Étiquette du fournisseur |
| `AI_BASE_URL` | Endpoint compatible OpenAI (ex. Groq) |
| `AI_API_KEY` | Clé API |
| `AI_MODEL` | Modèle (ex. `gpt-4o-mini`, `llama-3.x`) |

### Divers
| Variable | Rôle |
|---|---|
| `RELIEF_CONTACT_EMAIL` / `RELIEF_CONTACT_PHONE` | Coordonnées affichées |
| `CASE_TRACKING_PREFIX` | Préfixe des références (`RS`) |
| `WHATSAPP_ENABLED` / `WHATSAPP_PROVIDER` / `WHATSAPP_API_KEY` | Intégration WhatsApp |
| `PUSHER_*` / Firebase | Notifications temps réel / push |

---

## 12. Commandes artisan maison

| Commande | Rôle |
|---|---|
| `users:set-role {email} {role}` | Affecte `workflow_role` (`doctor`/`cnamgs`) |
| `sensitive-files:migrate [--delete]` | Migre les documents legacy vers le disque privé |
| `workflow:backfill-cases [--dry-run]` | Crée les dossiers médicaux à partir des folders |

---

## 13. Tests

Suite sur **SQLite en mémoire** (configuré dans `phpunit.xml`).

```bash
php artisan test                        # toute la suite (~139 verts)
php artisan test tests/Feature/Security # sécurité / non-régression
php artisan test --filter=Quote         # cibler un sujet
```

`tests/Feature/Security/` est le filet anti-régression : IDOR devis/dossiers,
RBAC back-office, signature + montant des webhooks, validation des uploads,
notifications de devis, workflow médical. **Toute évolution d'un flux sensible
doit être accompagnée d'un test.**

---

## 14. Déploiement

Déploiement **git-pull, sans Docker** ; `vendor/` **et** `public/build/` sont
**committés** (la prod ne lance ni `composer install` ni `npm build`).

```bash
bash deploy.sh
```

Le script : `git reset --hard origin/main` → `composer dump-autoload -o`
(best-effort) → **baseline** des migrations legacy → `migrate --force` →
`optimize:clear` + `config:cache` + `view:cache`.

⚠️ **Jamais de `route:cache`** : l'app utilise des routes en *closure*
(vérification e-mail) non sérialisables. `.env` n'est jamais écrasé.

> Après une modif front, **committer `public/build/`** (regénéré par
> `npm run build`). Après une nouvelle classe PHP, un `composer dump-autoload -o`
> committé garde le classmap optimisé à jour.

Détails : [`DEPLOYMENT.md`](DEPLOYMENT.md).
Accès serveur / hébergement (SSH, chemin, domaine) : _(à compléter en interne)_.

---

## 15. Conventions Git

- Branches : `feat/…`, `fix/…`, `chore/…` (kebab-case, 3-5 mots).
- Commits **conventionnels** : `type(scope): description` en anglais, impératif.
- **Ne jamais signer** les commits, pas de `--signoff`, pas de `Co-Authored-By`.
- Ne jamais `force-push` sur `main`.

---

## 16. Pièges à connaître (récap)

1. **Pas de queue** → mailables sans `ShouldQueue`, envoi synchrone (§9).
2. **Pas de `route:cache`** en prod (routes closure) (§14).
3. `vendor/` + `public/build/` **committés** — penser à les inclure (§14).
4. **Constantes `STATUT_*` globales** — garder `defined()` hors requête (§10).
5. Migrations **idempotentes** obligatoires (§10).
6. Documents sensibles **toujours** via `SensitiveFileStorage` + route Policy (§8).
7. Actions back-office : protéger avec `Controller::he_can(...)` (§8).
8. Flexbox : mettre `min-w-0` sur les colonnes flex contenant des tables larges
   (sinon débordement horizontal mobile).

---

## 17. Aller plus loin

| Document | Contenu |
|---|---|
| [`FEATURES.md`](FEATURES.md) | Détail fonctionnel par module |
| [`DESIGN_SYSTEM.md`](DESIGN_SYSTEM.md) | Tokens, composants, layouts |
| [`DEPLOYMENT.md`](DEPLOYMENT.md) | Procédure de déploiement détaillée |
| [`../SECURITY.md`](../SECURITY.md) | Modèle de sécurité, rotation des secrets |
| [`HARDENING_REPORT.md`](HARDENING_REPORT.md) | Durcissement appliqué |
| [`MIGRATION-L12.md`](MIGRATION-L12.md) | Historique de la migration Laravel 8→12 |
| [`UPGRADE_EXECUTION_PLAN.md`](UPGRADE_EXECUTION_PLAN.md) | Plan d'exécution de la montée de version |
