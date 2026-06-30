# Déploiement

## Option A — Recommandée (Composer sur le serveur)

```bash
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm ci && npm run prod   # si le build d'assets se fait sur le serveur
```

Pré-requis : PHP 8.2, Composer disponibles sur l'hôte (Hostinger : via SSH /
Terminal). Vérifier `php -v` et `composer --version`.

## Option B — Legacy temporaire (vendor versionné)

Tant que l'on n'a pas confirmé que `composer install` fonctionne sur l'hôte,
`vendor/` reste **committé** dans le dépôt et le déploiement peut se faire par
simple `git pull`. C'est l'état actuel.

> `/vendor` est déjà listé dans `.gitignore` comme marqueur, mais le dossier
> reste **suivi** par Git (un ajout dans `.gitignore` ne dé-suit pas un fichier
> déjà versionné). La bascule réelle est la checklist ci-dessous.

## Checklist de cutover `vendor/` (à exécuter une fois Composer confirmé)

1. Confirmer sur l'hôte :
   ```bash
   php -v            # 8.2+
   composer --version
   composer install --no-dev --optimize-autoloader   # doit réussir
   ```
2. Dé-suivre `vendor/` (il est déjà dans `.gitignore`) :
   ```bash
   git rm -r --cached vendor
   git commit -m "chore: stop tracking vendor dependencies"
   git push
   ```
3. Mettre à jour le process de déploiement pour inclure `composer install`
   (Option A) — sinon le serveur n'aura plus de dépendances après le pull.
4. Vérifier un déploiement de bout en bout sur un environnement de staging
   avant la production.

## Migration des documents sensibles (une fois par environnement)

Les anciens documents stockés sous `public/upload/*` doivent être déplacés vers
le stockage privé :

```bash
php artisan sensitive-files:migrate          # copie, ne supprime pas l'original
# après vérification :
php artisan sensitive-files:migrate --delete # supprime les originaux publics
```

## Variables d'environnement

Voir `.env.example`. En production : `APP_DEBUG=false`, secrets de paiement
renseignés, `PAYMENT_WEBHOOK_SECRET` défini, et `public/upload/.htaccess`
déployé.
