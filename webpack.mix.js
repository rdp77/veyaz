const mix = require('laravel-mix');
const MixGlob = require("laravel-mix-glob")

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

// Create MixGlob instance
const mixGlob = new MixGlob({ mix })

// Modules and extensions
// * Not Supported pnpm
// const modulesToCopy = {
//     "@icon/dripicons": false,
//     "@fortawesome/fontawesome-free": false,
//     "rater-js": false,
//     "bootstrap-icons": false,
//     apexcharts: true,
//     "perfect-scrollbar": true,
//     filepond: true,
//     "filepond-plugin-image-preview": true,
//     "feather-icons": true,
//     dragula: true,
//     dayjs: false,
//     "chart.js": true,
//     "choices.js": false,
//     parsleyjs: true,
//     sweetalert2: true,
//     summernote: true,
//     jquery: true,
//     quill: true,
//     tinymce: false,
//     "toastify-js": false,
//     "datatables.net-bs5": false,
//     "simple-datatables": true, // With dist folder = true
// }
// for (const mod in modulesToCopy) {
//     let modulePath = `node_modules/${mod}`
//     if (modulesToCopy[mod]) modulePath += "/public"
//
//     mix.copy(modulePath, `public/extensions/${mod}`)
// }

mixGlob
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/themes/dark/app-dark.scss", "public/css")
    .sass("resources/sass/pages/*.scss", "public/css/pages")
    .sass("resources/sass/widgets/*.scss", "public/css/widgets")
    .sass("resources/sass/iconly.scss", "public/css/shared")
    .js("resources/js/*.js", "public/js")

// Copying assets
mix
    .copy("resources/images", "public/images")
    .copy(
        "node_modules/bootstrap-icons/bootstrap-icons.svg",
        "public/images"
    )
    .copy("resources/js/pages", "public/js/pages")

if (mix.inProduction()) {
    mix.version();
}
