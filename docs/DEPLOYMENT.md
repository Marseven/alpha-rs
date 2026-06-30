# Déploiement — Hostinger (sans Docker)

Application Laravel 12 déployée sur un hébergement **Hostinger** (mutualisé ou
VPS) **sans Docker**. `vendor/` et `public/build` ne sont pas versionnés : on
exécute `composer install` et `npm run build` au déploiement.

## Pré-requis Hostinger

- **PHP 8.2+** : dans hPanel → *Avancé → Configuration PHP*, sélectionner PHP 8.2
  (ou 8.3) et activer les extensions : `bcmath`, `ctype`, `curl`, `dom`,
  `fileinfo`, `gd`, `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `tokenizer`, `xml`,
  `zip`, `intl`.
- **Composer** : disponible via SSH (`composer` ou `php8.2 /usr/local/bin/composer`).
- **Node.js** : pour builder les assets. Si Node n'est pas dispo sur l'hôte,
  builder en local (`npm run build`) et **uploader `public/build/`** (voir §B).
- **Base MySQL** : créée dans hPanel → *Bases de données MySQL* (récupérer nom,
  utilisateur, mot de passe, hôte).
- **Accès SSH** activé (hPanel → *Avancé → SSH*) — recommandé.

## Document root

Hostinger sert par défaut `public_html/`. Laravel doit exposer **`public/`**, pas
la racine du projet. Deux options :

- **Option recommandée (VPS / SSH)** : cloner le projet hors web root (ex.
  `~/alpha-rs`) et faire pointer le domaine sur `~/alpha-rs/public` (vhost VPS),
  ou créer un lien : `ln -s ~/alpha-rs/public ~/public_html`.
- **Mutualisé sans contrôle du vhost** : placer le contenu de `public/` dans
  `public_html/` et le reste du projet dans un dossier parent, puis adapter les
  chemins dans `public_html/index.php` :
  ```php
  require __DIR__.'/../alpha-rs/vendor/autoload.php';
  $app = require_once __DIR__.'/../alpha-rs/bootstrap/app.php';
  ```
  Copier aussi `public/.htaccess` et `public/build/` (+ `public/upload/.htaccess`).

## A. Déploiement par SSH + Git (recommandé)

```bash
# 1. Récupérer le code
cd ~/alpha-rs && git pull origin main      # (ou develop selon l'environnement)

# 2. Dépendances PHP (prod)
composer install --no-dev --optimize-autoloader

# 3. Assets front (si Node dispo sur l'hôte)
npm ci && npm run build

# 4. Environnement
#    (créer .env une seule fois, voir §Variables ; ne jamais le committer)
php artisan key:generate          # uniquement au premier déploiement

# 5. Base de données
php artisan migrate --force

# 6. Caches de production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Lien de stockage public
php artisan storage:link
```

## B. Déploiement sans Node sur l'hôte

Builder les assets en local puis les transférer :

```bash
# en local
npm ci && npm run build          # génère public/build/
# transférer public/build/ vers l'hôte (SFTP/rsync)
rsync -az public/build/ user@host:~/alpha-rs/public/build/
```

Le reste (composer install, migrate, caches) se fait comme en §A.

## Variables d'environnement (.env de production)

Copier `.env.example` puis renseigner :

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.tld

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=...        # base créée dans hPanel
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=database     # ou redis si dispo
QUEUE_CONNECTION=database   # voir §Tâches planifiées / files

# Paiements (obligatoire) + secret webhook — cf. SECURITY.md
SINGPAY_CLIENT_ID=... ; SINGPAY_CLIENT_SECRET=... ; SINGPAY_WALLET_ID=...
EBILLING_USERNAME=... ; EBILLING_SHARED_KEY=...
PAYMENT_WEBHOOK_SECRET=...
QUOTE_PAYMENT_AMOUNT=50000
```

> `APP_DEBUG=false` en production est impératif.

## Tâches planifiées & files d'attente

- **Scheduler** : ajouter un cron Hostinger (hPanel → *Tâches Cron*) :
  ```
  * * * * * cd ~/alpha-rs && php artisan schedule:run >> /dev/null 2>&1
  ```
- **Queues** (si `QUEUE_CONNECTION=database`) : créer la table une fois
  (`php artisan queue:table && php artisan migrate --force`) puis lancer un
  worker. Sur mutualisé sans worker persistant, utiliser un cron :
  ```
  * * * * * cd ~/alpha-rs && php artisan queue:work --stop-when-empty >> /dev/null 2>&1
  ```

## Permissions

```bash
chmod -R ug+rw storage bootstrap/cache
```

## Sécurité au déploiement (rappel)

- `public/upload/.htaccess` présent (blocage exécution + extensions sensibles).
- Documents sensibles servis via routes authentifiées (`storage/app/private`) —
  migrer les anciens fichiers : `php artisan sensitive-files:migrate`.
- Secrets uniquement dans `.env`. Rotation des secrets historiquement exposés et
  purge de l'historique Git : voir [`SECURITY.md`](../SECURITY.md).

## Checklist post-déploiement

- [ ] `https://domaine/` répond (page d'accueil)
- [ ] `php artisan about` montre `Environment=production`, `Debug=OFF`
- [ ] Connexion client + back-office OK
- [ ] Webhooks `/notify/*` joignables par le PSP (HTTPS)
- [ ] Aucun fichier sensible accessible (`/upload/quote/*.sql` → 403)
