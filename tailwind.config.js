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
            colors: {
                brand: {
                    DEFAULT: '#059669',
                    dark: '#047857',
                    darker: '#065f46',
                    light: '#f0fdf4',
                    accent: '#34d399',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                card: '0 4px 24px rgba(5, 150, 105, 0.08)',
                'card-hover': '0 8px 32px rgba(5, 150, 105, 0.14)',
            },
        },
    },

    plugins: [forms],
};
