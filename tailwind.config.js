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
                'primary-background': '#f4f1de',
                'primary': '#3d405b',
                'secondary': '#e07a5f',
                'accent': '#f2cc8f',
                'success': '#81b29a',
                'fail': '#E47070',
            },
        },
    },

    plugins: [forms],
};
