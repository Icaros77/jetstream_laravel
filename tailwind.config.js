const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    variants: {
        extend: {
            backgroundColor: ['hover']
        }
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            minWidth: {
                '1/5' : '20%',
                '2/5' : '40%',
                '3/5' : '60%',
                '10' : '10rem',
                '15' : '15rem',
                '20' : '20rem'
            },
            maxWidth: {
                '48' : '48%',
                'xs/2' : '10rem',
                
            },
            minHeight: {
                '8' : '8rem',
                '10' : '10rem',
                '12' : '12rem',
                '16' : '16rem',
                '1/2': '50vh',
                '1/4': '25vh',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
