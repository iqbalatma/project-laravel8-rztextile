const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js("resources/js/application/customers/index.js", "public/js/customers")
    .js("resources/js/application/units/index.js", "public/js/units")
    .js("resources/js/application/rolls/create.js", "public/js/rolls")
    .sass('resources/sass/app.scss', 'public/css');
