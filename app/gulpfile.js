const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const browsersync = require("browser-sync").create();
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const plumber = require("gulp-plumber");
const del = require("del");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const eslint = require("gulp-eslint");

// Get Template files
// const listTemplates = [
//   'src/templates/part-loading.php',
// ];

// Get Style files
const listStyles = ["src/scss/*.scss"];

// Get Script files
const listScripts = ["src/js/*.js"];

// Configure Server to BrowserSync
function browserSync(done) {
  browsersync.init({
    proxy: "http://localhost/interativawpbase"
  });
  done();
}

// Reload BrowserSync
function browserSyncReload(done) {
  browsersync.reload();
  done();
}

// Copy Template files to Dist folder
// function copyPHP() {
//   return gulp
//   .src(listTemplates)
//   .pipe(gulp.dest('dist/templates'));
// }

// Clean Dist folder
function clean() {
  return del(["dist/"]);
}

// Process Script files with ESLint
function scriptsLint() {
  return gulp
    .src(["src/js/**/*", "./gulpfile.js"])
    .pipe(plumber())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
}

// Process and bundle Style files
function css() {
  return gulp
    .src(listStyles)
    .pipe(plumber())
    .pipe(concat("style.min.css"))
    .pipe(sass({ outputStyle: "compressed" }))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(gulp.dest("dist/css"))
    .pipe(browsersync.stream());
}

// Process and bundle Style files to WatchFiles Task
function cssFast() {
  return gulp
    .src(listStyles)
    .pipe(plumber())
    .pipe(concat("style.min.css"))
    .pipe(sass({ outputStyle: "expanded" }))
    .pipe(postcss([autoprefixer()]))
    .pipe(gulp.dest("dist/css"))
    .pipe(browsersync.stream());
}

// Process and bundle Script files
function scripts() {
  return gulp
    .src(listScripts)
    .pipe(plumber())
    .pipe(concat("all.js"))
    .pipe(uglify())
    .pipe(gulp.dest("dist/js"))
    .pipe(browsersync.stream());
}
// Process and bundle Script files to WatchFiles Task
function scriptsFast() {
  return gulp
    .src(listScripts)
    .pipe(plumber())
    .pipe(concat("all.js"))
    .pipe(gulp.dest("dist/js"))
    .pipe(browsersync.stream());
}

// Watch files to rebuild
function watchFiles() {
  gulp.watch("src/scss/**/*", cssFast);
  gulp.watch("src/js/**/*", gulp.series(scriptsLint, scriptsFast));
  gulp.watch("[./]", gulp.series(browserSyncReload));
  // gulp.watch("src/templates/**/*", copyPHP);
}

// Set Gulp tasks
const js = gulp.series(scriptsLint, scripts);
const jsFast = gulp.series(scriptsLint, scriptsFast);
const build = gulp.series(clean, gulp.parallel(css, js));
const watch = gulp.series(clean, gulp.parallel(cssFast, jsFast), watchFiles);

exports.js = js;
exports.build = build;
exports.watch = watch;
exports.default = build;
