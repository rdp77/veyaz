const { src, dest, parallel , series , watch } = require('gulp');
// Gulp Sass
const sass = require('gulp-sass')(require('node-sass'));
const fileinclude = require('gulp-file-include');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const minify = require('gulp-minifier');
const strip = require('gulp-strip-comments');

// sass.compiler = require('node-sass'); // no-need fro gulp-sass v5+

var node_path = '../..';


function html(cb) {
  src('src/html/**')
  .pipe(dest('dist/html'));

  cb();
}

function scss(cb) {
  src(['src/scss/*.scss'])
  // .pipe(sourcemaps.init())               // If you want generate source map.
  .pipe(sass().on('error', sass.logError))  // uses {outputStyle: 'compressed'} in saas() for minify css
  // .pipe(sourcemaps.write('./'))          // If you want generate source map.
  .pipe(dest('dist/assets/css'));

  // EDITORS
  src(['src/scss/editors/*.scss'])
  // .pipe(sourcemaps.init())                                           // If you want generate source map.
  .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))   // remove {outputStyle: 'compressed'} from saas() if do not want to minify css
  // .pipe(sourcemaps.write('./'))                                      // If you want generate source map.
  .pipe(dest('dist/assets/css/editors'));

  src(['src/scss/libs/*.scss'])
  // .pipe(sourcemaps.init())                                           // If you want generate source map.
  .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))   // remove {outputStyle: 'compressed'} from saas() if do not want to minify css
  // .pipe(sourcemaps.write('./'))                                      // If you want generate source map.
  .pipe(dest('dist/assets/css/libs'));

  // SKINS
  src(['src/scss/skins/*.scss'])
  // .pipe(sourcemaps.init())               // If you want generate source map.
  .pipe(sass().on('error', sass.logError))  // uses {outputStyle: 'compressed'} in saas() for minify css
  // .pipe(sourcemaps.write('./'))          // If you want generate source map.
  .pipe(dest('dist/assets/css/skins'));

  cb();
}

function js_scripts(cb) {
  src(['src/js/*.js','!src/js/bundle.js'])
  // .pipe(uglify())                        // If you minify the code.
  .pipe(dest('dist/assets/js'));

  src(['src/js/charts/*.js'])
  // .pipe(uglify())                        // If you minify the code.
  .pipe(dest('dist/assets/js/charts'));

  src(['src/js/apps/*.js'])
  // .pipe(uglify())                        // If you minify the code.
  .pipe(dest('dist/assets/js/apps'));

  cb();
}

function js_bundle(cb) {
  src('src/js/bundle.js')
  .pipe(fileinclude({
    prefix: '@@',
    basepath: '@file',
    context: { build: 'dist', nodeRoot: node_path }
  }))
  .pipe(strip())
  .pipe(minify({ minify: true, minifyJS: { sourceMap: false } }))     // Disable, if you dont want to minify bundle file.
  .pipe(dest('dist/assets/js'));

  src(['src/js/libs/**', '!src/js/libs/editors/skins/**'])
  .pipe(fileinclude({
    prefix: '@@',
    basepath: '@file',
    context: { build: 'dist', nodeRoot: node_path }
  }))
  .pipe(strip())
  .pipe(minify({ minify: true, minifyJS: { sourceMap: false } }))     // Disable, if you dont want to minify bundle file.
  .pipe(dest('dist/assets/js/libs'));

  src('src/js/libs/editors/skins/**').pipe(dest('dist/assets/js/libs/editors/skins'));

  cb();
}

function assets(cb){
  src(['src/images/**'])
  .pipe(dest('dist/images'));

  src(['src/assets/**', '!src/assets/js/**', '!src/assets/css/**'])
  .pipe(dest('dist/assets'));

  cb();
}

exports.build = series(html, scss, js_scripts, js_bundle, assets);

exports.develop = function() {
    watch(['src/scss/*.scss','src/scss/**'], scss)
    watch(['src/html/*.html','src/html/**/*.html'], html)
    watch(['src/images/**', 'src/assets/**'], assets)
    watch(['src/js/*.js','src/js/charts/*.js', 'src/js/apps/*.js', '!src/js/bundle.js'], js_scripts)
    watch(['src/js/libs/**','src/js/bundle.js'], js_bundle)
};