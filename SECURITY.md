# Sécurité — Relief Services (alpha-rs)

## Secrets et rotation

Aucun secret ne doit figurer dans le code ou être commité. Tous les secrets
vivent dans `.env` (voir `.env.example` pour la liste).

> ⚠️ **Secrets historiquement compromis.** Des identifiants Singpay étaient
> codés en dur dans `PaymentController` et des dumps SQL étaient exposés dans
> `public/upload/quote/`. Ces valeurs sont **présentes dans l'historique Git**
> et doivent être considérées comme **compromises**.

### Procédure de rotation (à exécuter)

1. **Singpay** : régénérer `client_id` / `client_secret` et vérifier le wallet
   et le compte de disbursement côté tableau de bord Singpay. Mettre les
   nouvelles valeurs dans `.env` (`SINGPAY_*`).
2. **E-Billing (CGI)** : régénérer `username` / `shared_key` (`EBILLING_*`).
3. **Webhook** : définir un `PAYMENT_WEBHOOK_SECRET` fort (32+ octets aléatoires)
   et le partager avec le PSP pour la signature des notifications.
4. **Purge de l'historique Git** : les dumps SQL et secrets restent récupérables
   via l'historique. Purger avec `git filter-repo` (ou BFG) puis forcer la
   réécriture côté remote, après coordination avec l'équipe :
   ```bash
   git filter-repo --path public/upload/quote/satelisplus_1643361684_shap.sql --invert-paths
   git filter-repo --path public/upload/quote/satelisplus_1643361814_shap.sql --invert-paths
   # + nettoyer PaymentController dans l'historique si nécessaire
   ```
5. **Données tierces** : les dumps exposés appartenaient à un autre système
   (« satelisplus », gestion de décodeurs) — prévenir ce tiers : ses comptes
   marchands / tokens sont potentiellement compromis.

## Webhooks de paiement

Les routes `/notify/singpay` et `/notify/ebilling` exigent une signature
**HMAC-SHA256** valide (`PaymentWebhookVerifier`, en *fail-closed*). Le montant
attendu est calculé côté serveur ; le montant du payload doit correspondre et ne
peut jamais l'écraser. Seule la transition `PENDING → PAID` est permise
(idempotente sur rejeu).

En complément, une **vérification serveur-à-serveur (inquiry)** peut être exigée
via `PAYMENT_REQUIRE_PROVIDER_INQUIRY=true` : le webhook n'est validé qu'après
confirmation du statut **et** du montant par le PSP (`SingpayProvider` /
`EbillingProvider`), en *fail-closed* si l'inquiry n'est pas configurée.

**Résiduel :** aligner l'en-tête/le schéma de signature (`X-Webhook-Signature`)
et confirmer les endpoints d'inquiry réels (`SINGPAY_INQUIRY_URL`,
`EBILLING_INQUIRY_URL`) + le format de réponse avec les PSP.

## Contrôle d'accès

- Ressources client (devis, dossiers, paiements) protégées par des **Policies**
  (`QuotePolicy`, `FolderPolicy`) : un client n'accède qu'à ses propres données.
- Back-office protégé par le middleware `admin` (`IsAdmin`) + permissions fines
  `he_can()` (qui interrompt désormais réellement la requête via `abort(403)`).
- Changement de mot de passe réservé à l'utilisateur authentifié avec
  vérification de l'ancien mot de passe.

## Uploads

Les documents uploadés sont restreints (extensions `pdf/jpg/jpeg/png`, MIME réel
vérifié, 10 Mo max) et stockés sous un nom généré côté serveur, **sur le disque
privé** `storage/app/private/*` (plus jamais sous `public/`). Ils ne sont
servis que via des routes authentifiées et contrôlées par Policy :
`GET /files/quotes/{quote}/{field}` et `GET /files/folders/{folder}/{field}`
(champs whitelistés, chemin lu sur le modèle, jamais sur la requête).
Un `.htaccess` dans `public/upload` reste en défense en profondeur pour les
fichiers legacy non encore migrés.

**Migration des fichiers existants :** `php artisan sensitive-files:migrate`
(puis `--delete` après vérification) déplace les anciens fichiers publics vers
le stockage privé.

## Signaler une vulnérabilité

Contacter l'équipe technique en privé. Ne pas ouvrir d'issue publique.
