const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.ts('resources/main.ts', 'public/js/app.js');

//mix.sass('resources/sass/app.scss', 'public/css');

mix.alias({
    '@': path.join(__dirname, 'resources')
});

mix.vue();
