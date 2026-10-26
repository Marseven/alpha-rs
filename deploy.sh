#!/usr/bin/env bash
#
# Relief Services — script de déploiement (Hostinger, git-pull, sans Docker).
# À lancer depuis la racine du projet (public_html) :  bash deploy.sh
#
# Ce qu'il fait :
#   1. Récupère la dernière version de `main` (vendor/ et public/build/ sont committés).
#   2. Rafraîchit l'autoloader (best-effort).
#   3. "Baseline" les anciennes migrations (< 2024) une fois pour toutes, pour que
#      `php artisan migrate` cesse de rejouer des tables déjà existantes (simulators…).
#   4. Applique les migrations récentes (toutes idempotentes / guardées).
#   5. Vide et réchauffe les caches (config + vues). PAS de route:cache : l'app
#      utilise des routes en closure (vérification e-mail) non sérialisables.
#
# Le fichier .env est ignoré par git : il n'est jamais écrasé.

set -uo pipefail
cd "$(dirname "$0")" || exit 1

line() { printf '\n\033[1;34m==> %s\033[0m\n' "$1"; }

line "[1/5] Récupération du code (main)"
git fetch origin main || { echo "!! git fetch a échoué"; exit 1; }
git reset --hard origin/main || { echo "!! git reset a échoué"; exit 1; }
echo "    HEAD : $(git rev-parse --short HEAD) — $(git log -1 --pretty=%s)"

line "[2/5] Autoloader Composer"
if command -v composer >/dev/null 2>&1; then
    composer dump-autoload -o 2>/dev/null && echo "    autoloader régénéré"
else
    echo "    composer indisponible — ignoré (PSR-4 résout les nouvelles classes)"
fi

line "[3/5] Baseline des anciennes migrations (idempotent)"
php artisan tinker <<'PHP'
$existing = DB::table('migrations')->pluck('migration')->all();
$batch = (DB::table('migrations')->max('batch') ?? 0) + 1;
$legacy = collect(glob(database_path('migrations/*.php')))
    ->map(fn ($f) => basename($f, '.php'))
    ->reject(fn ($m) => in_array($m, $existing, true))
    ->reject(fn ($m) => $m >= '2024_')   // les migrations 2024+ doivent VRAIMENT tourner
    ->values();
if ($legacy->isNotEmpty()) {
    DB::table('migrations')->insert(
        $legacy->map(fn ($m) => ['migration' => $m, 'batch' => $batch])->all()
    );
}
echo "    baseline : " . $legacy->count() . " ancienne(s) migration(s) marquée(s) comme exécutée(s)\n";
PHP

line "[4/5] Migrations récentes"
php artisan migrate --force

line "[5/5] Caches"
php artisan optimize:clear || true
php artisan config:cache || true
php artisan view:cache || true
# route:cache volontairement omis (routes en closure non sérialisables).

# Garde-fou : la config est mise en cache ci-dessus, donc Laravel ne relit plus
# le .env au runtime. Si les clés Singpay ont été ajoutées au .env APRÈS un
# précédent config:cache, elles manquaient et le paiement échouait silencieusement
# ("missing configuration"). On vérifie ici qu'elles sont bien chargées.
line "Vérification — config de paiement Singpay"
php artisan tinker --execute='$m=array_filter(["client_id","client_secret","wallet_id"], fn($k)=>empty(config("services.singpay.".$k))); echo empty($m) ? "    Singpay: cles chargees OK" : "    /!\ Singpay: cles MANQUANTES en config -> ".implode(", ", $m)." (ajoutez-les au .env PUIS relancez deploy.sh)"; echo PHP_EOL;' || true

line "Terminé"
php artisan --version
echo "    Déploiement OK."
