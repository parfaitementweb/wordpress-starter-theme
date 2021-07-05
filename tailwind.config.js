module.exports = {
    purge: [
        './**/*.{vue,js,ts,jsx,tsx,blade.php,php,html}',
        './assets/js/components/**/*.{vue,js,ts,jsx,tsx,blade.php,php,html}',
    ],
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
