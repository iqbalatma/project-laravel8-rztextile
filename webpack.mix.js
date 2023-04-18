const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/app-layout.js", "public/js")
    .js("resources/js/pages/search-roll/index.js", "public/js/pages/search-roll")
    .js("resources/js/pages/whatsapp-messaging/index.js", "public/js/pages/whatsapp-messaging")
    .js("resources/js/pages/dashboard/index.js", "public/js/dashboard")
    .js("resources/js/pages/customers/index.js", "public/js/customers")
    .js("resources/js/pages/shopping/index.js", "public/js/shopping")
    .js("resources/js/pages/user-managements/index.js","public/js/pages/user-managements")
    .js("resources/js/pages/payments/create.js", "public/js/payments")
    .js("resources/js/pages/units/index.js", "public/js/pages/units")
    .js("resources/js/pages/reports/index.js", "public/js/reports")
    .js("resources/js/pages/rolls/create.js", "public/js/rolls")
    .js("resources/js/pages/rolls/index.js", "public/js/rolls")
    .js("resources/js/pages/promotion-messages/index.js", "public/js/pages/promotion-messages")
    .js("resources/js/pages/segmented-customers/index.js", "public/js/pages/segmented-customers")
    .js("resources/js/pages/roles/index.js", "public/js/pages/roles/index.js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/pages/segmented-customers.scss", "public/css/pages");
