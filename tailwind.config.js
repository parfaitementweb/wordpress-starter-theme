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
        extend: {},
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
