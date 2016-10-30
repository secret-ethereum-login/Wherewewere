/**
 * Created by Olaf Broms on 7/6/2016.
 */
var gulp         = require('gulp'),
    util        = require('gulp-util'),
    // plumber      = require('gulp-plumber'),
    // sourcemaps   = require('gulp-sourcemaps'),
    sass = require("gulp-sass"),//https://www.npmjs.org/package/gulp-sass
    autoprefixer = require('gulp-autoprefixer'),//https://www.npmjs.org/package/gulp-autoprefixer
    minifycss = require('gulp-minify-css'),//https://www.npmjs.org/package/gulp-minify-css
    rename = require('gulp-rename'),//https://www.npmjs.org/package/gulp-rename
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    size = require('gulp-size'),
    w3cjs = require('gulp-w3cjs'),
    phplint = require('gulp-phplint'),
    phpunit = require('gulp-phpunit'),
    tar = require('gulp-tar'),
    gzip = require('gulp-gzip'),
    codecept = require('gulp-codeception'),
    notify   = require('gulp-notify'),
  guppy = require('git-guppy')(gulp),
    _ = require('lodash'),
    pump = require('pump');
    log = util.log,

    browserSync  = require('browser-sync'),
    reload       = browserSync.reload;




gulp.task('browser-sync', ['sass'],  function() {
    browserSync({

        files: [ // Directories of the files, HTML/TXT/JS... etc
            'content/*.htm',
            'content/static-pages/*.htm',
            'content/placeholder/*.txt',
            'layouts/*.htm',
            'pages/*.htm',
            'partials/*.htm',
            '/styles/*.scss',
            '/javascript/*.js',
            '../*.html'
        ],
        open: 'external',
        host: 'what.local',  //your localhost
        proxy: 'what.local', //your localhost again
        port: '3000'


        // proxy: {
        //     target: "members/" // Enter your dev environment proxy
        // }
    });

    gulp.watch('*.html').on('change', reload); //watch html in base directory and reload browser
    gulp.watch('front-end-tools/styles/*.scss', ['sass']); // Watches the sass function
   gulp.watch('front-end-tools/javascript/*.js', ['compress']); // Watches the javascript uglification function
    gulp.watch('front-end-tools/styles/css/*.css').on('change', reload); //watch css and reload browser
    gulp.watch('front-end-tools/javascript/production-javascript/*.js').on('change', reload); //reload on javascript uglification
    gulp.watch('WhereWeWere.proj/**/*.php').on('change', reload); //reload page on proj php file change
    gulp.watch('WhereWeWere.proj/**/*.php',  ['codecept']);


});

//this is the new task....target properly
gulp.task('sass', function () {
    gulp.src('front-end-tools/styles/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(minifycss())
        .pipe(size())
        .pipe(gulp.dest('front-end-tools/styles/css/'))
        .on('end', function(){ util.log('Sass is now Compiled!!!!'); });

});
//
// gulp.task('compress', function (cb) {
//     pump([
//
//             gulp.src('javascript/*.js'),
//             uglify(),
//             gulp.dest('javascript/production-javascript')
//
//                 .on('end', function(){ util.log('Javascript is Uglified !!!!'); })
//         ],
//         cb
//     );
//
// });


var jsFiles = 'front-end-tools/javascript/*.js',
    jsDest = 'front-end-tools/javascript/production-javascript';

gulp.task('compress', function() {
    return gulp.src(jsFiles)
        .pipe(concat('combined.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(rename('functions.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest))
   .on('end', function(){ util.log('Javascript is Uglified !!!!'); });
});

//zips and backs up entire project into the backups directory MUST BE RUN MANUALLY
gulp.task('gzip-tar', function () {
    gulp.src('*')
        .pipe(tar('archive.tar'))
        .pipe(gzip())
        .pipe(size())
        .pipe(gulp.dest('front-end-tools/backups'))
});

gulp.task('create-git-hooks', function()
{
    gulp.src('front-end-tools/hooks/pre-commit')
       .pipe(gulp.dest('.git/hooks/'))
});

//html validator HAS NOT BEEN IMPLEMENTED YET
gulp.task('w3cjs', function () {
    gulp.src('')
        .pipe(w3cjs())
        .pipe(w3cjs.reporter());
});


gulp.task('codecept', function() {
    var options = {debug: false, flags: '--silent --report'};
    gulp.src('tests/*.php').pipe(codecept('codecept',options))
        .pipe(notify(notification('pass', 'CodeCeption Testing is Complete')));
});


function notification(status, message)
{
    var options = {
        icon: __dirname + 'node_modules/gulp-codeception/assets/test-' + status + '.png'
    };
    options = _.merge(options);
    return options;
}

gulp.task('pre-commit', ['codecept']);






gulp.task('default', ['browser-sync']);

