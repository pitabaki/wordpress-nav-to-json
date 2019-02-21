var gulp = require("gulp"),
    minify = require("gulp-minify"),
    watch = require("gulp-watch"),
    log = require("fancy-log");

var watchJS = "./assets/actions/*.js";

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
        .pipe(gulp.dest("./assets/actions/min"))
});