import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: 'oklch(0.96 0.03 150)',
                    100: 'oklch(0.92 0.06 150)',
                    500: 'oklch(0.52 0.14 150)',
                    600: 'oklch(0.45 0.12 150)',
                    900: 'oklch(0.25 0.08 150)',
                },
                gold: {
                    50: 'oklch(0.98 0.04 85)',
                    100: 'oklch(0.95 0.08 85)',
                    500: 'oklch(0.77 0.17 85)',
                    600: 'oklch(0.68 0.15 85)',
                },
                accent: {
                    50: 'oklch(0.97 0.03 260)',
                    500: 'oklch(0.56 0.23 260)',
                    600: 'oklch(0.48 0.20 260)',
                }
            },
            keyframes: {
                'fade-in-up': {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                'slide-in-right': {
                    '0%': { opacity: '0', transform: 'translateX(-20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                }
            },
            animation: {
                'fade-in-up': 'fade-in-up 0.5s ease-out',
                'fade-in': 'fade-in 0.3s ease-out',
                'slide-in-right': 'slide-in-right 0.4s ease-out forwards',
            }
        },
    },

    plugins: [forms],
};
