# Plan de migration Laravel 8 → Laravel 12

> **Pré-requis impératif :** ne **pas** démarrer la migration tant que la suite
> de tests sécurité (`tests/Feature/Security`) n'est pas verte. C'est le cas sur
> la branche `hotfix/security-first`. La migration se fait sur une branche
> dédiée `upgrade/laravel-12` créée **après** merge de la sécurité.

## 0. État actuel (constaté)

| Paquet | Version actuelle | Cible L12 | Saut |
|---|---|---|---|
| php | 8.2.27 (dispo) | ≥ 8.2 | ✅ compatible |
| laravel/framework | 8.83 | ^12.0 | majeur ×4 |
| laravel/jetstream | 2.9 | ^5.x | majeur |
| laravel/fortify | 1.13 | ^1.21+ | mineur |
| laravel/sanctum | 2.15 | ^4.x | majeur |
| livewire/livewire | 2.10 | ^3.x | **majeur, breaking** |
| laravel/ui | 3.4 | ^4.x | majeur |
| kreait/laravel-firebase | 3.4 | ^5.x | majeur |
| intervention/image | 2.7 | ^3.x | **API réécrite** |
| facade/ignition | 2.17 | → `spatie/laravel-ignition` ^2 | remplacé |
| fideloper/proxy | 4.4 | **supprimé** (intégré au noyau) | retrait |
| fruitcake/laravel-cors | 2.2 | **supprimé** (intégré au noyau) | retrait |

Marqueurs de structure « ancienne » à migrer :
- `app/Http/Kernel.php` et `app/Console/Kernel.php` présents → supprimés en L11+,
  middlewares/scheduling déplacés dans `bootstrap/app.php`.
- `webpack.mix.js` (Laravel Mix) → migration vers **Vite** recommandée.
- `vendor/` est versionné → à retirer du dépôt (CI fait `composer install`).

## 1. Blocages identifiés (à traiter avant/pendant)

1. **Livewire 2 → 3** : changements cassants majeurs (namespace `wire:`,
   `emit`→`dispatch`, montage, Alpine intégré). Les vues Jetstream et tous les
   composants Livewire custom doivent être audités un par un.
2. **Jetstream 2 → 5** : republication des vues/stubs, dépend de Livewire 3.
   Les vues `resources/views/profile/*` et `auth/*` ont été **personnalisées**
   (cf. 12 tests scaffolding actuellement rouges) → réconciliation manuelle
   nécessaire.
3. **intervention/image 2 → 3** : API changée (`Image::make()` →
   `ImageManager`). Impacte `FileController` (`picture()`, `user()`).
4. **Squelette L11+** : passage de `Http/Kernel.php` + `Console/Kernel.php` +
   `RouteServiceProvider` vers `bootstrap/app.php` (routing, middleware,
   exceptions, scheduling). Migration structurelle non triviale.
5. **`define()` des constantes `STATUT_*`** dans `Controller.php` : à déplacer
   vers une enum/classe de constantes (fragile, dépend de l'ordre de chargement).
6. **Helpers/typage dépréciés** et `swiftmailer` (abandonné) → `symfony/mailer`.

## 2. Stratégie recommandée (incrémentale, testée à chaque palier)

> Règle : `composer update <groupe>` → `php artisan test` → commit. On n'avance
> au palier suivant que si la suite reste verte.

### Palier A — Hygiène préalable (sur `hotfix/security-first`, déjà partiellement fait)
- [x] Rendre les dépendances compatibles PHP 8.2.
- [ ] Réparer ou retirer les 12 tests scaffolding Jetstream (réconcilier les
  vues personnalisées) pour partir d'une suite 100 % verte.
- [ ] `vendor/` → `.gitignore` (+ `git rm -r --cached vendor`).

### Palier B — Sauts intermédiaires de framework
Laravel ne se saute pas de 8 à 12 d'un coup. Procéder par paliers :
`8 → 9 → 10 → 11 → 12`. À chaque palier :
1. Mettre à jour `laravel/framework` + dépendances de premier rang.
2. Appliquer les changements du *upgrade guide* officiel correspondant.
3. `php artisan test`.

- **8 → 9** : PHP 8.0+, Flysystem 3, `symfony/mailer`, retrait de
  `fideloper/proxy` (TrustProxies intégré).
- **9 → 10** : PHP 8.1+, types natifs, `laravel/sanctum` ^3, `intervention/image` ^3.
- **10 → 11** : **nouveau squelette** — migrer `Kernel.php`/providers vers
  `bootstrap/app.php`, `spatie/laravel-ignition`, retrait `fruitcake/cors`.
- **11 → 12** : surtout des mises à jour de dépendances et ajustements mineurs.

### Palier C — Écosystème Jetstream/Livewire
- Livewire 2 → 3 (suivre le *upgrade guide* Livewire, audit composant par composant).
- Jetstream 2 → 5, republier et **re-fusionner** les vues personnalisées.
- Sanctum 2 → 4.

### Palier D — Front-end (Mix → Vite)
- Ajouter `vite` + `laravel-vite-plugin`, créer `vite.config.js`.
- Remplacer `mix()` par `@vite([...])` dans les layouts Blade.
- Adapter les imports CSS/JS, Tailwind 2 → 3/4 si souhaité, Alpine via Livewire 3.
- `npm install && npm run build`.

### Palier E — Validation finale
```bash
composer test
php artisan test
php artisan route:list
npm run build
```

## 3. Filet de sécurité
La suite `tests/Feature/Security` sert de **garde-fou anti-régression** pendant
toute la migration : aucune étape ne doit la faire repasser au rouge. Compléter
au fur et à mesure par des tests Feature sur les flux métier (devis, dossier,
paiement) avant d'attaquer les paliers C/D, plus risqués.

## 4. Estimation
~15–25 jours/homme selon l'ampleur de la personnalisation Livewire/Jetstream et
le choix Mix vs Vite. À mener après stabilisation, jamais en même temps que des
correctifs de sécurité.
