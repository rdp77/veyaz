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
// mix.styles(
//     ["resources/css/dashlite.css", "resources/css/theme.css"],
//     "public/css/style.css"
// )
//     // Javascript Main
//     .js(
//         ["resources/js/bundle.js", "resources/js/scripts.js"],
//         "public/assets/scripts.js"
//     )
//     .version();

// SCSS Main
// mix.combine("resources/scss/*.scss", "public/assets/css.css")
//     // SCSS Editors
mix.combine("resources/scss/editors/", "public/assets/css/editors.css");
//     .combine("resources/scss/libs/*.scss", "public/assets/css/libs.css")
//     // SCSS Skins
//     .combine("resources/scss/skins/*.scss", "public/assets/css/skins.css")
//     .version();

// mix.js("resources/js/app.js", "public/assets/js")
//     .js("resources/js/charts/*.js", "public/assets/js/charts/*.js")
//     .js("resources/js/apps/*.js", "public/assets/js/apps")
//     .version();

mix.disableNotifications();
