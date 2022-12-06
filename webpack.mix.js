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
    .js("resources/js/application/app-layout.js", "public/js")
    .js("resources/js/application/dashboard/index.js", "public/js/dashboard")
    .js("resources/js/application/customers/index.js", "public/js/customers")
    .js("resources/js/application/shopping/index.js", "public/js/shopping")
    .js("resources/js/application/payments/create.js", "public/js/payments")
    .js("resources/js/application/units/index.js", "public/js/units")
    .js("resources/js/application/rolls/create.js", "public/js/rolls")
    .sass('resources/sass/app.scss', 'public/css');
