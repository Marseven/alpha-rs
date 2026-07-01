# Déploiement — Hostinger (sans Docker, sans Composer/npm serveur)

Modèle de déploiement **réel et validé en production** pour ce projet.

- Déploiement = **`git pull` seul**. `vendor/` **et** `public/build/` sont
  **versionnés** dans le dépôt → aucun `composer install` ni `npm` sur l'hôte.
- L'application est **Laravel 12** → elle **exige PHP 8.2** côté web.

## ⚠️ Point n°1 — PHP 8.2 pour le SITE WEB (pas seulement le CLI)

Sur cet hébergement (CloudLinux/LiteSpeed), le **PHP par défaut en SSH/CLI est
8.0**, mais le PHP qui sert le site se règle **séparément** dans hPanel.

1. hPanel → **Sites web** → `reliefservices.net` → **Avancé → Configuration PHP**.
2. **Version PHP → 8.2** (ou 8.3) → Enregistrer.
3. **Extensions** : `sodium`, `intl`, `gd`, `bcmath`, `mbstring`, `curl`, `zip`,
   `exif`, `fileinfo`, `openssl`, `tokenizer`, `dom`, `pdo_mysql`.

> Symptôme si le web est resté en 8.0 : HTTP 500 partout (y compris `/up`) avec,
> dans la sortie, « *Your Composer dependencies require a PHP version >= 8.2.0* »
> (émis par `vendor/composer/platform_check.php`). ⇒ le domaine n'est pas en 8.2.

Pour lancer artisan en CLI, **forcer le binaire 8.2** (le `php` par défaut = 8.0) :
```bash
/opt/alt/php82/usr/bin/php artisan <commande>
```

## Déploiement standard (à chaque mise à jour)

```bash
cd ~/domains/reliefservices.net/public_html
git pull origin main
rm -f bootstrap/cache/*.php        # purge un éventuel cache config/route hérité
```
C'est tout : `vendor/` et `public/build/` arrivent par le pull. Recharger le site.

Vérifier : `https://reliefservices.net/up` doit renvoyer
`{"status":"ok","database":"ok"}`.

## Base de données & migrations (⚠️ table `migrations` désynchronisée)

La base de prod contient déjà toutes les tables **mais la table `migrations`
n'est pas synchronisée** : un `php artisan migrate` « nu » échoue avec
`SQLSTATE[42S01] ... Table 'simulators' already exists` (il tente de recréer des
tables existantes).

**L'application est conçue pour tourner SANS migration en attente** :
- `SoftDeletes` est **désactivé** sur `Quote/Folder/Payment` (la colonne
  `deleted_at` n'existe pas en prod) ;
- `profile_photo_path` absent = photo par défaut (aucune erreur) ;
- les index additionnels = perf uniquement.

Donc **ne pas lancer `migrate`** en routine. Si un jour il faut appliquer de
nouvelles migrations :
1. Synchroniser d'abord la table `migrations` (marquer comme exécutées les
   migrations dont les tables existent déjà) — insérer leurs noms dans
   `migrations`, ou repartir d'un `schema:dump` aligné.
2. Puis exécuter uniquement les migrations voulues avec le binaire 8.2 :
   `/opt/alt/php82/usr/bin/php artisan migrate --force`.
3. Pour ré-activer les soft deletes : remettre `use SoftDeletes` sur les 3
   modèles **après** avoir appliqué `add_soft_deletes` (colonne `deleted_at`).

## Document root

Le domaine sert `public_html/`, avec un `.htaccess` racine qui réécrit vers
`public/` (le vrai docroot Laravel). Une sonde de test doit donc être placée
dans `public/` (ex. `public/phpver.php`), pas à la racine — et **supprimée**
après usage (ne jamais laisser de `phpinfo`/version en ligne).

## Variables d'environnement (`.env` de prod, non versionné)

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://reliefservices.net

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=u670117648_alpha
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=database

# Paiements + secret webhook (cf. SECURITY.md)
SINGPAY_CLIENT_ID=... ; SINGPAY_CLIENT_SECRET=... ; SINGPAY_WALLET_ID=...
EBILLING_USERNAME=... ; EBILLING_SHARED_KEY=...
PAYMENT_WEBHOOK_SECRET=...
QUOTE_PAYMENT_AMOUNT=50000
```
`APP_DEBUG=false` impératif en production.

## Tâches planifiées (optionnel)

Cron Hostinger avec le binaire 8.2 :
```
* * * * * cd ~/domains/reliefservices.net/public_html && /opt/alt/php82/usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

## Sécurité (rappel)

- `public/upload/.htaccess` présent (blocage exécution + extensions sensibles).
- Secrets uniquement dans `.env`. **Rotation des secrets historiquement exposés
  + purge de l'historique Git** : voir [`SECURITY.md`](../SECURITY.md).
- Documents sensibles → route authentifiée ; migration : `sensitive-files:migrate`.

## Note sur `vendor/` versionné

`vendor/` est committé **volontairement** pour permettre le déploiement par
`git pull` sur un hôte sans Composer. Il inclut les dépendances de dev (inertes
avec `APP_DEBUG=false`). Si un accès Composer devient disponible, on pourra
repasser à un `vendor` `--no-dev` et re-`.gitignore`r le dossier.

## Checklist post-déploiement

- [ ] hPanel : domaine en **PHP 8.2** + extensions (dont `sodium`)
- [ ] `git pull` effectué, `bootstrap/cache/*.php` purgé
- [ ] `https://reliefservices.net/up` → `{"status":"ok","database":"ok"}`
- [ ] Accueil, connexion client et back-office OK
- [ ] Aucune sonde `phpver.php` laissée en ligne
- [ ] Webhooks `/notify/*` joignables par le PSP (HTTPS)
