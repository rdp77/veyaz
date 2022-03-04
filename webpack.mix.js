let mix = require("laravel-mix");

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

// CSS Main
mix.styles(
    ["resources/css/dashlite.css", "resources/css/theme.css"],
    "public/css/style.css"
)
    // Javascript Main
    .js(
        ["resources/js/bundle.js", "resources/js/scripts.js"],
        "public/assets/scripts.js"
    )
    .version();

// SCSS Main
// mix.sass("resources/scss/*.scss", "public/assets/css")
//     // SCSS Editors
//     .sass("resources/scss/editors/*.scss", "public/assets/css/editors")
//     .sass("resources/scss/libs/*.scss", "public/assets/css/libs")
//     // SCSS Skins
//     .sass("resources/scss/skins/*.scss", "public/assets/css/skins")
//     .version();

// mix.js("resources/js/app.js", "public/assets/js")
//     .js("resources/js/charts/*.js", "public/assets/js/charts/*.js")
//     .js("resources/js/apps/*.js", "public/assets/js/apps")
//     .version();

mix.disableNotifications();
