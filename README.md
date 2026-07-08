# Relief Services (alpha-rs)

Application Laravel d'assurance / assistance / évacuation sanitaire pour le
marché gabonais : site public, demande de devis avec pièces justificatives,
espace client, back-office d'administration, simulateur, annuaire d'hôpitaux et
paiement en ligne (**Singpay**, **E-Billing CGI**).

> 🚀 **Nouveau·elle sur le projet ?** Commencez par le
> [**Guide de prise en main**](docs/ONBOARDING.md).

- **Framework :** Laravel 12 (PHP 8.2+). Migration 8→12 réalisée par paliers,
  voir [`docs/UPGRADE_EXECUTION_PLAN.md`](docs/UPGRADE_EXECUTION_PLAN.md).
- **Front :** Blade (couche de vue), Livewire 3, Alpine.js, Tailwind 3,
  build **Vite** (`public/build/` committé).
- **Auth :** Jetstream 5 / Fortify / Sanctum 4.
- **Tests :** PHPUnit 11 (SQLite en mémoire) ; `vendor/` **committé** pour le
  déploiement git-pull.

## Installation

```bash
git clone https://github.com/Marseven/alpha-rs.git
cd alpha-rs

composer install
cp .env.example .env
php artisan key:generate

# Configurer la base de données et les passerelles de paiement dans .env
php artisan migrate

npm install
npm run build      # ou: npm run dev (serveur de dev Vite)
php artisan serve
```

> Sous MAMP, utiliser un binaire PHP 8.2 (`/Applications/MAMP/bin/php/php8.2.x/bin/php`).

## Variables d'environnement

Outre les variables Laravel standard (`APP_*`, `DB_*`, `MAIL_*`), configurer :

| Variable | Rôle |
|---|---|
| `SINGPAY_BASE_URL` / `SINGPAY_CLIENT_ID` / `SINGPAY_CLIENT_SECRET` | API Singpay |
| `SINGPAY_WALLET_ID` / `SINGPAY_DISBURSEMENT_WALLET_ID` | Portefeuilles Singpay |
| `EBILLING_BASE_URL` / `EBILLING_POST_URL` | Endpoints E-Billing |
| `EBILLING_USERNAME` / `EBILLING_SHARED_KEY` | Identifiants E-Billing |
| `PAYMENT_WEBHOOK_SECRET` | Secret HMAC de vérification des webhooks de paiement |

Toutes ces clés sont **obligatoires en production** et ne doivent jamais être
commitées. Voir [`SECURITY.md`](SECURITY.md) pour la rotation des secrets.

## Tests

La suite tourne sur SQLite en mémoire (configuré dans `phpunit.xml`).

```bash
php artisan test                       # toute la suite
php artisan test tests/Feature/Security # tests de sécurité / non-régression
```

Les tests de `tests/Feature/Security` couvrent : IDOR sur devis/dossiers,
changement de mot de passe, accès back-office + RBAC, signature et montant des
webhooks de paiement, validation des uploads. Ils servent de filet
anti-régression, notamment pendant la migration Laravel 12.

> La suite est verte (~139 tests, 6 skippés). Historique de la migration :
> [`docs/MIGRATION-L12.md`](docs/MIGRATION-L12.md).

## Sécurité

Voir [`SECURITY.md`](SECURITY.md) : rotation des secrets, webhooks signés +
inquiry serveur-à-serveur, contrôle d'accès (Policies + RBAC), **stockage privé
des documents** et téléchargement contrôlé (`/files/quotes|folders/{id}/{field}`).

Migration des documents existants vers le stockage privé :

```bash
php artisan sensitive-files:migrate          # copie (non destructif)
php artisan sensitive-files:migrate --delete # supprime les originaux publics
```

Détails de durcissement : [`docs/HARDENING_REPORT.md`](docs/HARDENING_REPORT.md).
Déploiement et bascule `vendor/` : [`docs/DEPLOYMENT.md`](docs/DEPLOYMENT.md).

## Déploiement

Déploiement **git-pull, sans Docker** : `vendor/` **et** `public/build/` sont
committés, la prod ne lance donc ni `composer install` ni `npm build`.

```bash
bash deploy.sh
```

Le script fait : `git reset --hard origin/main` → `composer dump-autoload -o`
(best-effort) → **baseline** des migrations legacy → `migrate --force` →
`optimize:clear` + `config:cache` + `view:cache`.

⚠️ **Pas de `route:cache`** (routes en closure non sérialisables). `.env` de
prod : `APP_DEBUG=false` + secrets renseignés. Vérifier que
`public/upload/.htaccess` est déployé (blocage d'exécution). Détails :
[`docs/DEPLOYMENT.md`](docs/DEPLOYMENT.md) · [`docs/ONBOARDING.md`](docs/ONBOARDING.md).

> Après une modif front, committer `public/build/` (regénéré par `npm run build`).

## CI

Le workflow [`.github/workflows/tests.yml`](.github/workflows/tests.yml) installe
PHP 8.2, les dépendances Composer, génère une clé et exécute `php artisan test`
sur SQLite à chaque push / pull request.
