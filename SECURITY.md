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

**Résiduel :** aligner l'en-tête / le schéma de signature
(`X-Webhook-Signature`) avec ce que le PSP envoie réellement. Si un PSP ne signe
pas ses notifications, ajouter une vérification serveur-à-serveur (inquiry) avant
de valider le paiement — ne jamais faire confiance au seul payload entrant.

## Contrôle d'accès

- Ressources client (devis, dossiers, paiements) protégées par des **Policies**
  (`QuotePolicy`, `FolderPolicy`) : un client n'accède qu'à ses propres données.
- Back-office protégé par le middleware `admin` (`IsAdmin`) + permissions fines
  `he_can()` (qui interrompt désormais réellement la requête via `abort(403)`).
- Changement de mot de passe réservé à l'utilisateur authentifié avec
  vérification de l'ancien mot de passe.

## Uploads

Les documents uploadés sont restreints (extensions `pdf/jpg/jpeg/png`, MIME réel
vérifié, 10 Mo max) et stockés sous un nom généré côté serveur. Un `.htaccess`
dans `public/upload` bloque l'exécution de scripts et l'accès aux extensions
sensibles.

**Résiduel recommandé :** déplacer les documents sensibles vers
`storage/app/private` et les servir via une route de téléchargement authentifiée
(les PDF/images restent aujourd'hui accessibles par URL directe).

## Signaler une vulnérabilité

Contacter l'équipe technique en privé. Ne pas ouvrir d'issue publique.
