import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import aspectRatio from '@tailwindcss/aspect-ratio';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js', // Include JS files for dynamic UI behavior (if any)
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gray: {
                    800: '#1f2937',
                    700: '#374151',
                    100: '#f3f4f6',
                },
                indigo: {
                    500: '#6366f1',
                },
            },
            spacing: {
                '8': '2rem',
                '10': '2.5rem',
            },
        },
    },

    plugins: [
        forms,
        aspectRatio,
        typography,
    ],
};
