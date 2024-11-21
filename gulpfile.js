const {src, dest, watch, series} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const terser = require('gulp-terser');
const concat = require('gulp-concat');
const notify = require('gulp-notify');
const sourcemaps = require('gulp-sourcemaps');

function css(done) {
    src('src/scss/**/*.scss')
    .pipe (sourcemaps.init())
    .pipe(sass( {outputStyle: "compressed"} ))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/build/css'))
    done()
}

function js(done) {
    src('src/js/**/*.js')
    .pipe(webpack({
        module: {
            rules: [
                {
                    test: /\.css$/i,
                    use: ["style-loader", "css-loader"],
                }
            ]
        },
        mode: "production",
        entry: "./src/js/app.js"
    }))
    .pipe(sourcemaps.init())
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/build/js'))
    done()
}

function watchArchivos() {
    watch('src/scss/**/*.scss', css)
    watch('src/js/**/*.js', js)
}

//WebPack
const webpack = require('webpack-stream');

exports.watchArchivos = watchArchivos;
exports.default = series(css, js, watchArchivos)