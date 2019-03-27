var gulp = require("gulp"),
    minify = require("gulp-minify"),
    watch = require("gulp-watch"),
    log = require("fancy-log"),
    cssMinify = require("gulp-clean-css"),
    sass = require("gulp-sass");

var watchJS = "./prod/assets/actions/*.js",
    sassFile = "./prod/scss/style.scss",
    sassFileDest = "./dist/anaplan-nav-menu-json/assets/components/css/";

gulp.task("scripts", function(){
    console.log("JavaScript files being watched at " + watchJS);
    return gulp.src(watchJS)
		.pipe(minify({
			ext:{
				src: '.js',
				min: '-min.js'
			}
		}))
        .on('pipe', function(){ log('Done!'); })
        .pipe(gulp.dest("./dist/anaplan-nav-menu-json/assets/actions"))
});

gulp.task('sass', function(){
	return gulp.src(sassFile)
		.pipe(sass().on('error', sass.logError))
		.pipe(cssMinify({compatibility: 'ie8'}))
		.pipe(gulp.dest(sassFileDest));
});


gulp.task('god', ['scripts','sass']);