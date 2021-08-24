const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    purge: {
        content: [
            './404.php',
            './archive.php',
            './footer.php',
            './header.php',
            './index.php',
            './page.php',
            './search.php',
            './sidebar.php',
            './single.php',
            './template-parts/*.php',
            './template-parts/blocks/*.php',
            './assets/**/*.{js,css}',
        ],
        options: {
            safelist: [/^fa-/, /^wpml-/, /^mce-/, /^acf-/, /wp-block/ , /block-editor-block-list__block/],
        }
    },
    mode: 'jit',
    darkMode: false, // or 'media' or 'class'
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                sm: '1.5rem',
                lg: '1.5rem',
                xl: '1.5rem',
                '2xl': '0',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'catalina': {
                    '50': '#f3f4f8',
                    '100': '#e6e9f2',
                    '200': '#c1c9de',
                    '300': '#9ca8ca',
                    '400': '#5167a3',
                    '500': '#07267B',
                    '600': '#06226f',
                    '700': '#051d5c',
                    '800': '#04174a',
                    '900': '#03133c'
                },
                'bright': {
                    '50': '#fffdf5',
                    '100': '#fffbea',
                    '200': '#fff5cb',
                    '300': '#ffefac',
                    '400': '#ffe26e',
                    '500': '#FFD630',
                    '600': '#e6c12b',
                    '700': '#bfa124',
                    '800': '#99801d',
                    '900': '#7d6918'
                }
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
}
