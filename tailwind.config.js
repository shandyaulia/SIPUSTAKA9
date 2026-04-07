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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Urbanist', 'sans-serif'],
            },
            colors: {
                brand: {
                    blue: '#0B3B60',
                    light: '#3B82F6',
                    yellow: '#FBBF24',
                    dark: '#031321'
                }
            }
        },
    },

    plugins: [forms],
};
