var gulp = require("gulp"),
    minify = require("gulp-minify"),
    watch = require("gulp-watch"),
    log = require("fancy-log"),
    cssMinify = require("gulp-clean-css"),
    sass = require("gulp-sass");

var watchJS = "./anaplan-nav-menu-json/assets/actions/*.js",
    sassFile = "./scss/style.scss",
    sassFileDest = "./anaplan-nav-menu-json/assets/components/css/";

gulp.task("scripts", function(){
    console.log("JavaScript files being watched at " + watchJS);
    return gulp.src(watchJS)
        .pipe(watch(watchJS))
		.pipe(minify({
			ext:{
				src: '.js',
				min: '-min.js'
			}
		}))
        .on('pipe', function(){ log('Done!'); })
        .pipe(gulp.dest("./anaplan-nav-menu-json/assets/actions/min"))
});

gulp.task('sass', function(){
	return gulp.src(sassFile)
		.pipe(sass().on('error', sass.logError))
		.pipe(cssMinify({compatibility: 'ie8'}))
		.pipe(gulp.dest(sassFileDest));
});