var gulp = require('gulp');

// Installation task
gulp.task('install', function(){
    gulp.src('./node_modules/jquery/dist/jquery.js')
        .pipe(gulp.dest('./web/vendor/dist/'));
});
