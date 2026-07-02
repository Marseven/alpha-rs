# Fonctionnalités métier — Relief Services

Trois modules ajoutés : **images du site**, **assistant IA**, **workflow médical
médecin → CNAMGS → patient**.

## Déploiement des nouvelles tables (prod git-pull)

Le serveur ne peut pas lancer `php artisan migrate`. Appliquer **une fois** le
script SQL dans phpMyAdmin : [`docs/PROD_SQL_2024_05.sql`](PROD_SQL_2024_05.sql).
En local/CI, les migrations Laravel suffisent (`php artisan migrate`).

## Migration des données existantes (prod)

Après avoir appliqué le schéma SQL, migrer les données existantes avec les
commandes Artisan (utiliser le binaire PHP 8.2 sur le serveur) :

```bash
# 1) Rendre les dossiers (folders) existants suivables (crée un dossier de
#    workflow par folder ; idempotent). Vérifier d'abord à blanc :
/opt/alt/php82/usr/bin/php artisan workflow:backfill-cases --dry-run
/opt/alt/php82/usr/bin/php artisan workflow:backfill-cases

# 2) Assigner les rôles workflow aux comptes concernés :
/opt/alt/php82/usr/bin/php artisan users:set-role medecin@exemple.com doctor
/opt/alt/php82/usr/bin/php artisan users:set-role cnamgs@exemple.com pharmacy
```

Les deux commandes sont idempotentes/sûres et peuvent être relancées.

---

## 1. Changer les images du site

- Admin → **Images du site** (`/admin/site-images`).
- Slots gérés : image principale (accueil), image « À propos », bannière
  services, bannière contact.
- Formats acceptés : **JPG, PNG, WEBP**, **4 Mo max**. Le fichier est renommé
  côté serveur et stocké dans `public/upload/site/`.
- Si aucune image n'est configurée, l'image par défaut du thème est utilisée.
- Ajouter un slot : compléter `SiteSetting::IMAGE_KEYS`, puis afficher via
  `{{ \App\Models\SiteSetting::image('cle', 'images/defaut.png') }}`.

## 2. Assistant IA (questions-réponses)

- Page publique : **`/assistant`**.
- Configurer dans `.env` :
  ```env
  AI_ASSISTANT_ENABLED=true
  AI_PROVIDER=openai
  AI_API_KEY=sk-...
  AI_MODEL=gpt-4o-mini
  RELIEF_CONTACT_EMAIL=contact@reliefservices.net
  RELIEF_CONTACT_PHONE=+241...
  ```
- Sécurité intégrée :
  - Les questions **médicales/sensibles** (diagnostic, médicament, douleur,
    urgence…) reçoivent un message de prudence — **l'IA n'est jamais appelée**.
  - Prompt contraint : ne répond que sur services, démarches, documents, suivi,
    contacts. Pas de diagnostic ni de promesse de prise en charge.
  - **Fallback** : si `AI_ASSISTANT_ENABLED=false` ou clé absente, un message
    propre est renvoyé (le site ne plante pas) et la question est marquée
    `needs_human_review`.
- Historique : toutes les questions/réponses sont stockées dans `ai_questions`
  (statuts : `answered`, `failed`, `needs_human_review`).

## 3. Workflow médical (médecin → CNAMGS → patient)

### Rôles
Colonne `users.workflow_role` : `doctor`, `pharmacy` (= CNAMGS), `admin`.
Assigner via SQL/admin :
```sql
UPDATE users SET workflow_role='doctor'   WHERE email='...';
UPDATE users SET workflow_role='pharmacy' WHERE email='...';
```
(Les admins existants — rôle sécurité « admin » — ont accès à tout.)

### Médecin — `/doctor/cases`
- Voit **uniquement** ses dossiers (`doctor_id`).
- Ouvre un dossier, ajoute une note, choisit une CNAMGS, **envoie le dossier**.
- À l'envoi : statut `sent_to_pharmacy`, horodatage, entrée d'historique, et
  email de notification à la CNAMGS.

### CNAMGS / Pharmacie — `/pharmacy/cases`
- Voit **uniquement** les dossiers qui lui sont envoyés (`pharmacy_id`).
- Met à jour le statut : `received_by_pharmacy`, `in_review`,
  `missing_information`, `ready`, `completed`, `cancelled` (+ note).
- Chaque changement est **historisé** (`medical_case_status_histories`).

### Patient — `/track-case` (public)
- Saisit **numéro de suivi + téléphone**.
- Voit uniquement : numéro de suivi, nom **masqué** (Jean D.), **message de
  statut** clair, date de mise à jour.
- **Jamais** de documents médicaux ni de notes internes ; un mauvais téléphone
  ne révèle rien.

### Sécurité
- `MedicalCaseWorkflowPolicy` : médecin ↔ `doctor_id`, CNAMGS ↔ `pharmacy_id` ;
  admins via `Gate::before`. Middleware `workflow_role:doctor|pharmacy`.
- Statuts validés côté serveur ; toutes les transitions sont journalisées.

### Créer un dossier de workflow
Un `MedicalCaseWorkflow` peut être lié à un `Folder` existant (`folder_id`) ou
créé isolément. Le `tracking_number` est généré automatiquement
(`RS-XXXXXX`, préfixe `CASE_TRACKING_PREFIX`). L'assignation d'un `doctor_id`
peut se faire côté admin (à compléter selon le besoin).

## Notifications
- Envoi d'un email à la CNAMGS à l'envoi d'un dossier (si email présent).
- Table `case_notifications` (channel email/sms/whatsapp, statut
  pending/sent/failed). SMS/WhatsApp : **préparés** mais non branchés à une API
  réelle (voir `WHATSAPP_*` dans `.env.example`).

## Points restant à faire (évolutions)
- UI admin pour créer un dossier workflow depuis un `Folder` et assigner le
  médecin (aujourd'hui : assignation via données / à compléter).
- Notifications SMS/WhatsApp réelles quand les clés PSP seront disponibles.
- Mise en cache des `site_settings` (2 requêtes par page d'accueil aujourd'hui).
- Réactiver les soft deletes une fois les migrations applicables en prod.
