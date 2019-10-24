const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

function css() {
  return gulp.src('./src/*.{sass, scss}')
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(gulp.dest('./build'));
}

function js() {
  return gulp.src('./src/*.js')
    .pipe(babel({
      presets: ['@babel/env'],
    }))
    .pipe(uglify())
    .pipe(gulp.dest('./build'));
}

function watch() {
  gulp.watch('./src/*.{sass, scss}', css);
  gulp.watch('./src/*.js', js);
}

exports.default = gulp.series(css, js, watch);
exports.css = css;
exports.js = js;
exports.watch = watch;
