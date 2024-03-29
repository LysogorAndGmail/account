const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

// public page
mix.js([
    'resources/js/public/bootstrap.bundle.min.js',
    'resources/js/public/functions.js',
    'resources/js/app.js'
    ], 'public/assets/js/app.js');

mix.styles([
    'resources/css/public/bootstrap.css',
    'resources/css/public/theme.css',
    'resources/css/theme.css',
], 'public/assets/css/app.css');