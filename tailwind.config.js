import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',       // ← AGREGADO
        './resources/js/**/*.vue',     // ← AGREGADO
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                fadeIn: "fadeIn 1s ease-in-out",
                fadeInSlow: "fadeIn 2s ease-in-out",
                slideDown: "slideDown 0.8s ease-out",
            },
            keyframes: {
                fadeIn: {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
                fadeInSlow: {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
                slideDown: {
                    "0%": { opacity: 0, transform: "translateY(-20px)" },
                    "100%": { opacity: 1, transform: "translateY(0)" },
                },
            },
        },
    },

    plugins: [forms],
};
