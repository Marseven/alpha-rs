import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // Relief Services — palette dérivée du logo (bleu confiance → rouge CTA).
            colors: {
                primary: {
                    50: '#EAF3FC', 100: '#D6E9F9', 200: '#BFDCF5', 300: '#8FC2ED',
                    400: '#5FAAE3', 500: '#2492E3', 600: '#1568B8', 700: '#135FA9',
                    800: '#104E8C', 900: '#0C3B66', 950: '#081F36',
                },
                accent: { // rouge — CTA principaux UNIQUEMENT
                    50: '#FDECF0', 100: '#F8C6D2', 300: '#EE5C7E', 600: '#E11D48', 700: '#BE123C',
                },
                success: { 50: '#E7F6ED', 200: '#BDE6CD', 600: '#178A47', 700: '#14713C' },
                warning: { 50: '#FDF3E3', 200: '#F2DEB2', 500: '#E8A33D', 700: '#92400E' },
                ink: { DEFAULT: '#12263F', muted: '#5B6B7F', faint: '#9AA8B8' },
                line: { DEFAULT: '#E3E9F0', strong: '#C8D3DF', subtle: '#EDF1F5' },
                canvas: { DEFAULT: '#F5F8FB' },
            },
            fontFamily: {
                display: ['Poppins', ...defaultTheme.fontFamily.sans],
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                card: '0 2px 8px rgba(18,38,63,.07)',
                'card-lg': '0 12px 32px rgba(18,38,63,.10)',
                cta: '0 8px 20px rgba(225,29,72,.25)',
            },
            borderRadius: {
                xl: '12px',
                '2xl': '16px',
                '3xl': '24px',
            },
            maxWidth: {
                container: '1200px',
            },
            backgroundImage: {
                'brand-line': 'linear-gradient(90deg,#2E9BE8,#7A5BC0,#E11D48)',
            },
        },
    },

    plugins: [forms, typography],
};
