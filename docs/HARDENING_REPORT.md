# Rapport de durcissement — branche `hardening/post-security-fixes`

Suite de `hotfix/security-first`. Principe : Security First · Test First ·
No regression. Petits commits, tests avant correction.

## 1. Résumé des corrections réalisées
| Phase | Sujet | Statut |
|---|---|---|
| 1 | Stockage privé des documents sensibles + téléchargement contrôlé | ✅ |
| 2 | Réparation de la suite Jetstream/Fortify (0 échec) | ✅ |
| 3 | Bugs métier (relations, `delais_hour`, sync hôpital, `findOrFail`) | ✅ |
| 3.2 | Centralisation et cohérence des montants de paiement | ✅ |
| 4 | Inquiry serveur-à-serveur des paiements (fail-closed) | ✅ |
| 5 | Préparation sortie `vendor/` (non destructif) | ✅ |
| 6 | Index BDD additifs | ✅ |
| 7 | Plan d'exécution Laravel 12 | ✅ |
| 8 | Documentation + rapport | ✅ |

## 2. Tests ajoutés / réparés
**Ajoutés (suite sécurité, 48 tests) :** `PrivateDocumentTest` (6),
`BusinessBugfixTest` (4), `PaymentAmountTest` (3), `PaymentInquiryTest` (3) —
en plus des 32 existants.
**Réparés (scaffolding) :** Authentication, Registration, ProfileInformation,
UpdatePassword, TwoFactorAuthenticationSettings, DeleteAccount, ExampleTest.

## 3. Résultat de la suite complète
`php artisan test` → **73 passed, 0 failed, 6 skipped**.
Les 6 *skipped* sont auto-ignorés par les tests car les features Jetstream/Fortify
correspondantes sont désactivées par choix (API tokens, vérification email).

## 4. Résultat de la suite sécurité
`php artisan test tests/Feature/Security` → **48 passed**.

## 5. Stockage privé des documents
Documents (passeport, rapport, examen, devis, pièce dossier) stockés sur
`storage/app/private/*` via `SensitiveFileStorage` ; téléchargement via
`GET /files/quotes|folders/{id}/{field}` (auth + Policy + whitelist de champs).
Admins autorisés via `Gate::before`. Commande `sensitive-files:migrate` pour les
fichiers legacy. `.htaccess` conservé en défense en profondeur.

## 6. Vérification paiement / inquiry
Webhooks : signature HMAC (fail-closed) + montant attendu (résolveur) +
transition `PENDING→PAID` idempotente. Inquiry serveur-à-serveur optionnelle
(`PAYMENT_REQUIRE_PROVIDER_INQUIRY`) confirmant statut + montant ;
`SingpayProvider`/`EbillingProvider` fail-closed si non configurés.

## 7. Bugs métier corrigés
`Country::towns()` (FK), `User::hospitals()` (classe inexistante),
`delais_hour()` (format → Carbon), `Hospital::sick()` (sync, anti-doublon),
`find()`→`findOrFail()` sur `updateState`, conversion devis→dossier
(`join_piece`), `RegisterController` (`phone` optionnel).

## 8. Index BDD ajoutés
Migration additive : `quotes/folders(user_id, service_id, status)`,
`payments(customer_id, folder_id, quote_id, reference, status)`,
`towns(country_id)`, `hospital_sick(hospital_id, sick_id)`. Types inchangés.
Contraintes uniques sur pivots **reportées** (risque de doublons existants).

## 9. Nettoyage vendor
`/vendor` ajouté au `.gitignore` (marqueur) ; **toujours suivi** pour ne pas
casser un déploiement `git pull`. Checklist de bascule dans `docs/DEPLOYMENT.md`.

## 10. Plan Laravel 12
`docs/MIGRATION-L12.md` (analyse) + `docs/UPGRADE_EXECUTION_PLAN.md` (ordre des
PRs 8→9→10→11→12, commandes, stratégies Livewire 2→3 / Mix→Vite / Jetstream,
rollback). Exécution à faire sur `upgrade/laravel-12-prep`.

## 11. Risques résiduels
- Secrets toujours présents dans l'historique Git (purge requise).
- Schéma de signature webhook + endpoints d'inquiry à confirmer avec les PSP.
- Types de colonnes (varchar pour dates/montants/booléens) non modifiés.
- Contraintes uniques pivots non posées (dédup préalable nécessaire).
- `vendor/` encore versionné jusqu'à confirmation du déploiement Composer.

## 12. Actions humaines obligatoires
1. **Rotation des secrets compromis** : clés Singpay, credentials E-Billing,
   tokens/comptes marchands présents dans les dumps SQL exposés.
2. **Purge de l'historique Git** (`git filter-repo`) — en coordination équipe.
3. **Coordination PSP** : format exact des webhooks, signature native,
   endpoint d'inquiry, liste des statuts, règles timeout/retry.
4. Exécuter `php artisan sensitive-files:migrate` par environnement.

## Commandes de validation (résultats)
```
php artisan test tests/Feature/Security   → 48 passed
php artisan test                          → 73 passed, 6 skipped, 0 failed
php artisan route:list                    → OK (files.quote, files.folder présents)
composer validate                         → ./composer.json is valid
```
