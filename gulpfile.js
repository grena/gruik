var gulp = require('gulp');

// Installation task
gulp.task('install', function(){
    gulp.src([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/ace-builds/src-min/ace.js',
        './node_modules/ace-builds/src-min/mode-markdown.js',
        './node_modules/ace-builds/src-min/theme-github.js',
        './node_modules/marked/lib/marked.js'
    ]).pipe(gulp.dest('./web/vendor/dist/'));
});
