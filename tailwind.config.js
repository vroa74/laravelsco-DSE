import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [
            require("./vendor/wireui/wireui/tailwind.config.js")
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif'],
            },
            fontSize: {
                '11px': '0.6875rem', // 11px
                '10px': '0.625rem', // 10px
                '9px': '0.5625rem', // 9px
                '8px': '0.5rem', // 8px
                '7px': '0.4375rem', // 7px
                '6px': '0.375rem', // 6px
                '5px': '0.3125rem', // 5px
            },
        },
    },

    plugins: [
        forms,
        typography,
        require('flowbite/plugin'),
    ],

};
