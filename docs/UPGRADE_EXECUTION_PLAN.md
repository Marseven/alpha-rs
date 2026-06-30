# Plan d'exécution — Migration Laravel 8 → 12

> **STATUT (réalisé) :** paliers 1→4 faits sur `upgrade/laravel-12-prep`
> (PR [#2](https://github.com/Marseven/alpha-rs/pull/2)) : **Laravel 12.62**,
> Livewire 3, Jetstream 5, Sanctum 4, PHPUnit 11. Suite 73 verts / 6 skip.
> **Restant :** migration squelette `bootstrap/app.php` (optionnelle) et
> **Mix → Vite** (build front). PHP 8.3+ requis pour `kreait/laravel-firebase` ^7.

> Complète `docs/MIGRATION-L12.md` (analyse) avec l'ordre exact des PRs, les
> commandes et les stratégies. **Ne pas exécuter** tant que la suite n'est pas
> 100 % verte et que paiements/documents ne sont pas stabilisés (c'est le cas
> sur `hardening/post-security-fixes`). Travailler sur une branche dédiée :
>
> ```bash
> git checkout hardening/post-security-fixes
> git checkout -b upgrade/laravel-12-prep
> ```

## Pré-conditions (Definition of Ready)
- [x] Suite complète verte (73 passed, 0 failed) — filet anti-régression.
- [x] Secrets externalisés, webhooks signés + inquiry, documents privés.
- [ ] `vendor/` dé-suivi (Option A déploiement) — recommandé avant la montée.
- [ ] Snapshot/branche de rollback + sauvegarde BDD.

## Trajectoire : 8 → 9 → 10 → 11 → 12 (un palier = une PR)

Règle commune à chaque PR : `composer update ...` → corriger → `php artisan test`
→ commit. Ne jamais sauter un palier.

### PR 1 — Laravel 8 → 9
- PHP ≥ 8.0 (OK, on est en 8.2).
- `composer require laravel/framework:^9.0 -W`
- Packages : `nunomaduro/collision:^6`, `spatie/laravel-ignition` (remplace
  `facade/ignition`), `nesbot/carbon:^2.62`, Flysystem 3.
- Code : retirer `fideloper/proxy` (TrustProxies intégré), `symfony/mailer`.
- Tests : `php artisan test`. Critère : 0 régression.

### PR 2 — Laravel 9 → 10
- PHP ≥ 8.1.
- `composer require laravel/framework:^10.0 laravel/sanctum:^3 -W`
- `intervention/image:^3` → adapter `FileController::picture()/user()`
  (`Image::make()` → `new ImageManager()`).
- `laravel/ui:^4`, `nunomaduro/collision:^7`, PHPUnit 10 (ou Pest 2).
- Tests + ajuster les types/retours dépréciés.

### PR 3 — Laravel 10 → 11 (le plus structurant)
- PHP ≥ 8.2 (OK).
- Nouveau squelette : migrer `app/Http/Kernel.php`, `app/Console/Kernel.php`,
  `RouteServiceProvider` vers `bootstrap/app.php`
  (`->withRouting()`, `->withMiddleware()`, `->withExceptions()`).
- Remettre les alias middleware (`admin`), groupes, `$except` CSRF, scheduling.
- `laravel/sanctum:^4`, retrait `fruitcake/laravel-cors` (CORS intégré).
- Déplacer les constantes `STATUT_*` (`define()` dans `Controller.php`) vers une
  enum/classe dédiée.
- Tests : viser 0 régression ; la suite sécurité reste le garde-fou.

### PR 4 — Laravel 11 → 12
- Principalement des bumps de dépendances + ajustements mineurs.
- `composer require laravel/framework:^12.0 -W`.

### PR 5 — Jetstream / Fortify / Livewire (peut chevaucher PR 2-3)
- `laravel/jetstream:^5`, `laravel/fortify` à jour, `livewire/livewire:^3`.
- **Livewire 2 → 3** : `emit`→`dispatch`, attributs `wire:`, montage, Alpine
  intégré ; auditer chaque composant. Republier les stubs Jetstream et
  **re-fusionner** les vues personnalisées (`resources/views/profile/*`,
  `auth/*`) — attention au double usage actuel (composants Livewire + pages
  custom UserController).
- Tests Jetstream/Fortify : doivent rester verts.

### PR 6 — Front-end Mix → Vite
- `npm remove laravel-mix && npm i -D vite laravel-vite-plugin`
- Créer `vite.config.js`, remplacer `mix()` par `@vite([...])` dans les layouts.
- Tailwind 2 → 3/4 (optionnel), Alpine via Livewire 3.
- `npm install && npm run build`.

## Commandes de validation (à chaque PR)
```bash
composer test || php artisan test
php artisan route:list
npm run build        # à partir de PR 6
composer validate
```

## Stratégie de tests
- La suite `tests/Feature/Security` (48 tests) est le filet anti-régression
  prioritaire : aucune PR ne doit la faire rougir.
- Avant PR 3 et PR 5 (les plus risquées), compléter par des tests Feature sur
  les parcours métier (devis, dossier, paiement, admin) si manquants.

## Rollback
- Chaque PR est isolée et revert-able (`git revert` du merge).
- Conserver une branche `pre-upgrade-snapshot` + dump BDD avant PR 3 (squelette)
  et PR 5 (Livewire), les deux paliers à plus haut risque.
- Les migrations ajoutées sont additives et possèdent un `down()`.

## Estimation
~15–25 j/h selon l'ampleur de la personnalisation Livewire/Jetstream et le
choix Mix→Vite.
