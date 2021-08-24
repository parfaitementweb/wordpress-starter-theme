let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('assets/js/app.js', 'app.js');

mix.postCss('assets/css/main.css', 'main.css');
mix.postCss('assets/css/editor-style.css', 'editor-style.css');
mix.postCss('assets/css/custom_blocks.css', 'custom_blocks.css');

mix.options({
    postCss: [
        require("postcss-import"),
        require('postcss-nested'),
        require('tailwindcss'),
        require('autoprefixer')
    ]
});

/*
 |--------------------------------------------------------------------------
 | DO NOT EDIT BELOW
 |--------------------------------------------------------------------------
 */
mix.setPublicPath('dist');
/*
 |--------------------------------------------------------------------------
 | DO NOT EDIT ABOVE
 |--------------------------------------------------------------------------
 */
