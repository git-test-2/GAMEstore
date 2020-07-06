var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglifyjs'),
    cssnano = require('gulp-cssnano'),
    rename = require('gulp-rename'),
    imagemin = require('gulp-imagemin'),
    filesize = require('gulp-size'),
    image = require('gulp-image'),
    cache = require('gulp-cache'),
    pngquant = require('imagemin-pngquant'),
    del = require('del'),
    cssconcat = require('gulp-concat-css_1'),
    autoprefixer = require('gulp-autoprefixer'),
    jade = require('gulp-jade');


// gulp jade
gulp.task('jade', function() {
    gulp.src('app/jade/*.jade')
        .pipe(jade({
            pretty: true
        }))
        .on('error', console.log) // Если есть ошибки, выводим и продолжаем
        .pipe(gulp.dest('app/')); // Записываем собранные файлы
});

/*	sass => css_1, добавление префиксов, вывод в css_1 */
gulp.task('sass', function () {
    return gulp.src('app/sass/*.+(sass|scss)')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {cascade: true}))
        .pipe(gulp.dest('app/css_1'))
        .pipe(browserSync.reload({stream: true}))
});

/*  сборка CSS библиотек и минификация    */
gulp.task('css_1-libs', function () {
    return gulp.src(
        'app/css_1/vendor/*.css_1'
    ) // Выбираем файл для сборки
        .pipe(cssconcat('./libs.min.css_1'))
        .pipe(filesize({
            title: 'CSS->',
            showFiles: true
        }))
        .pipe(gulp.dest('app/css_1')); // Выгружаем в папку app/css_1
});

/*  сборка, сжатие и минификация скриптов   */
gulp.task('scripts', function () {
    return gulp.src([ // Берем все необходимые библиотеки

    ])
        .pipe(concat('libs.min.js_1'))
        .pipe(uglify())
        .pipe(filesize({
            title: 'JS-libs.min ->',
            showFiles: true
        }))
        .pipe(gulp.dest('app/js_1'));
});

/*	Удаляем папку dist перед сборкой, не было дублей	*/
gulp.task('clean', function () {
    return del.sync('dist');
});

/*	Оптимизация изображений	*/
gulp.task('img', function () {
    gulp.src('app/img/**/*')
        .pipe(cache(image({
            pngquant: true,
            optipng: false,
            zopflipng: true,
            advpng: true,
            jpegRecompress: false,
            jpegoptim: true,
            mozjpeg: true,
            gifsicle: true,
            svgo: true
        })))
        .pipe(gulp.dest('dist/img'));
});

/*	Livereload	*/
gulp.task('browser-sync', function () {
    browserSync({
        server: {
            baseDir: 'app'
        },
        notify: false
    });
});

/*  Синхронизация   */
gulp.task('watch', ['browser-sync', 'jade', 'css-libs', 'scripts'], function () {
    gulp.watch('app/sass/**/*.+(sass|scss)', ['sass']);
    gulp.watch('app/css_1/**/*.css_1');
    gulp.watch('app/css_1/libs/*.sass', ['css_1-libs']);
    gulp.watch('app/*.html', browserSync.reload);
    gulp.watch('app/jade/**/*.jade', ['jade']);
    gulp.watch('app/js_1/*.js_1', browserSync.reload);
});

/*	Сборка проекта	*/
gulp.task('build', ['clean', 'img', 'jade', 'sass', 'scripts'], function () {

    // Переносим библиотеки в продакшен
    var buildCss = gulp.src([
        'app/css_1/main.css_1',
        'app/css_1/media.css_1',
        'app/css_1/libs.min.css_1'
    ])
        .pipe(cssnano()) // Минификация
        .pipe(filesize({
            showFiles: true
        })) // Размер файла
        .pipe(gulp.dest('dist/css_1'));

    // Переносим шрифты в продакшен
    var buildFonts = gulp.src('app/fonts/**/*')
        .pipe(gulp.dest('dist/fonts'));

    // Переносим стандарт библиотеки
    var buildLibsJs = gulp.src('app/libs/**/*')
        .pipe(gulp.dest('dist/libs'));
    // Переносим скрипты в продакшен
    var buildJs = gulp.src('app/js_1/**/*')
        .pipe(gulp.dest('dist/js_1'));
    // Переносим HTML в продакшен
    var buildHtml = gulp.src('app/*.html')
        .pipe(gulp.dest('dist'));
});

/*очистка кеша*/
gulp.task('clear', function () {
    return cache.clearAll();
});

gulp.task('default', ['watch']);
