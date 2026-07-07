# Relief Services — Note de style (Design System v1)

Identité unifiée pour les 3 surfaces (public / espace client / admin), Blade + Tailwind 3.4.
Palette **dérivée du logo** (dégradé bleu → rouge) : le bleu porte la confiance médicale,
le rouge est réservé aux CTA.

## 1. Couleurs (tokens `tailwind.config.js`)

```js
// tailwind.config.js — theme.extend.colors
colors: {
  primary: {  // bleu Relief — liens, nav, boutons secondaires, surfaces app
    50:'#EAF3FC', 100:'#D6E9F9', 200:'#BFDCF5', 300:'#8FC2ED',
    400:'#5FAAE3', 500:'#2492E3', 600:'#1568B8', 700:'#135FA9',
    800:'#104E8C', 900:'#0C3B66', 950:'#081F36',
  },
  accent: {   // rouge Relief — CTA principaux UNIQUEMENT
    50:'#FDECF0', 100:'#F8C6D2', 300:'#EE5C7E', 600:'#E11D48', 700:'#BE123C',
  },
  success: { 50:'#E7F6ED', 200:'#BDE6CD', 600:'#178A47', 700:'#14713C' },
  warning: { 50:'#FDF3E3', 200:'#F2DEB2', 500:'#E8A33D', 700:'#92400E' },
  ink:     { DEFAULT:'#12263F', muted:'#5B6B7F', faint:'#9AA8B8' }, // texte
  line:    { DEFAULT:'#E3E9F0', strong:'#C8D3DF', subtle:'#EDF1F5' }, // bordures
  canvas:  { DEFAULT:'#F5F8FB' }, // fond de page app
}
```

- **Texte** : `ink` (#12263F) sur clair ; blanc / `primary-100` (#B8D2EA) sur navy. Contrastes AA vérifiés.
- **Rouge** : jamais en texte long, jamais en fond de section. Un seul CTA rouge visible par écran.
- **Dégradé marque** `linear-gradient(90deg,#2E9BE8,#7A5BC0,#E11D48)` : filets fins (6px max),
  soulignés décoratifs. Jamais en fond de texte ni de bouton.
- **Sidebars** : client `primary-900` (#0C3B66), admin `primary-950` (#081F36). Item actif :
  fond `rgba(255,255,255,.12)` + barre gauche 3px `#2E9BE8`.

## 2. Badges de statut (workflow CNAMGS)

| Statut | Libellé FR | Style |
|---|---|---|
| DRAFT | Brouillon | ink-muted sur #F5F8FB, bordure line |
| SENT_TO_CNAMGS | Transmis CNAMGS | primary-700 sur primary-50 |
| RECEIVED_BY_CNAMGS | Reçu CNAMGS | primary-700 sur primary-50 |
| IN_REVIEW | En cours d'examen | warning-700 sur warning-50 |
| MISSING_INFORMATION | Pièce manquante | accent-700 sur accent-50 |
| READY | Prêt | success-700 sur success-50 |
| COMPLETED | Terminé | blanc sur success-600 (plein) |
| CANCELLED | Annulé | ink-muted barré sur #EDF0F4 |

Forme : pill (`rounded-full`), 12–13px semi-bold, padding 5×12, bordure 1px teintée.

## 3. Typographie

- **Titres** : Poppins ExtraBold (800) — police dérivée du wordmark du logo. Tracking -0.01em sur les display.
- **Corps** : Manrope (400–800), line-height 1.6, corps ≥ 15px web / ≥ 16px mobile.
- **Mono** : JetBrains Mono — références dossier (RSA-…), eyebrows UPPERCASE (tracking .14em), montants techniques.
- Une seule échelle : 50/42 (hero) · 38 (h2 section) · 24–17 (cartes) · 15–13 (corps/labels).

## 4. Composants (resources/views/components/)

- **button** : radius 8px. `accent` (rouge, CTA unique), `primary` (bleu), `outline` (bordure 1.5px primary), `ghost` (fond #F5F8FB). Hauteur ≥ 44px.
- **card** : blanc, bordure 1px line, radius 16px, ombre `0 2px 8px rgba(18,38,63,.07)` ; élevée `0 12px 32px rgba(18,38,63,.10)` ; carte mise en avant : bordure top 3px accent.
- **field/input** : bordure 1.5px #C8D3DF, radius 8px, focus bordure primary + ring `rgba(21,104,184,.15)`. Astérisque rouge = requis.
- **badge** : cf. §2. **alert/flash** : fond 50 + bordure 200 de la couleur sémantique, icône + action à droite.
- **table** : header #F9FBFD uppercase 11.5px, lignes 1px #EDF1F5, ligne sélectionnée fond #F7FAFD + barre gauche primary.
- **stat-card** : label 12.5px muted, valeur 32px Poppins ExtraBold, delta en pill success/warning.
- **timeline** : verticale (track public) / horizontale (dossier). Fait = success plein + check, courant = anneau warning 3px + halo, à venir = anneau line.

## 5. Motion

Transitions 150–250ms `cubic-bezier(0.4,0,0.2,1)`. Hover boutons : assombrir (accent-700 / primary-700). Cartes : +4px d'élévation d'ombre, pas de translation forte. Carrousel hero : CSS scroll-snap ou Livewire, pause au survol, flèches clavier, `aria-live="polite"`. Aucun wow.js/jQuery.

## 6. Do / Don't

- ✅ Un CTA rouge par écran ; le reste en bleu/outline.
- ✅ Eyebrow mono uppercase au-dessus des titres de section.
- ✅ Fond de page app #F5F8FB, sections publiques alternées blanc / #F5F8FB, navy réservé aux bandeaux.
- ❌ Pas de dégradé en fond de bouton ou de texte. Pas d'emoji. Pas de vert/rouge hors sémantique statut.
- ❌ Ne pas toucher aux `name=""` ni aux endpoints (`join_piece_*`, `/quote`, `/folder/pay/{id}`, `/admin/quotes-state/{id}`).

## 7. Fontes

Google Fonts : `Poppins:700;800` (titres), `Manrope:300..800` (corps), `JetBrains+Mono:400..600` (étiquettes), chargées via `@vite`/`bunny.net` en préconnect.
