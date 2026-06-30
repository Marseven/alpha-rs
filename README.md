# Relief Services (alpha-rs)

Application Laravel d'assurance / assistance / évacuation sanitaire pour le
marché gabonais : site public, demande de devis avec pièces justificatives,
espace client, back-office d'administration, simulateur, annuaire d'hôpitaux et
paiement en ligne (**Singpay**, **E-Billing CGI**).

- **Framework :** Laravel 8 (PHP 8.2) — migration Laravel 12 planifiée, voir
  [`docs/MIGRATION-L12.md`](docs/MIGRATION-L12.md).
- **Front :** Blade, Livewire 2, Alpine.js 2, Tailwind 2 (Laravel Mix).
- **Auth :** Jetstream / Fortify / Sanctum.

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
npm run dev        # ou: npm run prod
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

> Remarque : certains tests de scaffolding Jetstream sont rouges (vues
> personnalisées) — voir le palier A de [`docs/MIGRATION-L12.md`](docs/MIGRATION-L12.md).

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

1. `composer install --no-dev --optimize-autoloader`
2. `.env` de production (`APP_DEBUG=false`, secrets de paiement renseignés).
3. `php artisan migrate --force`
4. `php artisan config:cache route:cache view:cache`
5. `npm ci && npm run prod`
6. S'assurer que `public/upload/.htaccess` est déployé (blocage d'exécution).

## CI

Le workflow [`.github/workflows/tests.yml`](.github/workflows/tests.yml) installe
PHP 8.2, les dépendances Composer, génère une clé et exécute `php artisan test`
sur SQLite à chaque push / pull request.
