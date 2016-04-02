var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var concat = require('gulp-concat');

// Installation task
gulp.task('install', function() {
    gulp.src([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/font-awesome/css/font-awesome.min.css'
    ]).pipe(gulp.dest('./web/vendor/dist/'));

    gulp.src(
        './node_modules/font-awesome/fonts/**/*' , {base: './node_modules/font-awesome/'}
    ).pipe(gulp.dest('./web/vendor/'));

    gulp.src(
        './node_modules/semantic-ui-css/**/*', {base: './node_modules/'}
    ).pipe(gulp.dest('./web/vendor/'));
});

// Compile less
gulp.task('less', function () {
    return gulp.src('./src/**/Resources/public/css/*.less')
        .pipe(less())
        .pipe(concat('all.css'))
        .pipe(gulp.dest('./web/css'));
});
