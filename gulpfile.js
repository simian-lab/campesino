'use strict'

var cssNano = require('gulp-cssnano'),
	htmlMin = require('gulp-htmlmin'),
	imageMin = require('gulp-imagemin'),
	gulp = require('gulp'),
	sass = require('gulp-sass'),
	bourbon = require('node-bourbon'),
	browserSync = require("browser-sync").create(),
	rev = require('gulp-rev'),
	uglify = require('gulp-uglify'),
	usemin = require('gulp-usemin');

// Minify HTML
gulp.task('html', async function() {
	gulp.src('prod/index.html')
	.pipe(htmlMin({collapseWhitespace: true}))
	.pipe(gulp.dest('prod'));
});

// Minify our images.
gulp.task('images', async function() {
	gulp.src('dev/images/**/*')
	.pipe(imageMin())
	.pipe(gulp.dest('prod/images'));
});

//Task for reloading the page
gulp.task('reload', function() {
  browserSync.reload();
});

gulp.task('root-files', async function() {
	gulp.src('dev/*.{ico,png,txt,xml}')
	.pipe(gulp.dest('prod'));
});

//Task for compiling scss files
gulp.task('sass', async function () {
	gulp.src('dev/styles/**.scss')
		.pipe(sass({
			includePaths: bourbon.includePaths,
			outputStyle: 'compressed',
			sourcemap: true
		}).on('error', sass.logError))
		.pipe(gulp.dest('dev/styles/'))
		.pipe(browserSync.stream())
});

//Static server + watching scss/html files
gulp.task('serve', gulp.series(['sass'], function() {
	browserSync.init({
		server: "dev"
	});
}));

gulp.task('usemin', async function() {
	gulp.src('dev/index.html')
	.pipe(usemin({
		css: [cssNano(), rev()]
	}))
	.pipe(gulp.dest('prod'));
});

//Task for watching scss/html/js files changes
gulp.task('watch', function(){
	gulp.watch('dev/**/*.scss', ['sass']);
	gulp.watch("dev/**/*.html", ['reload']);
	gulp.watch("dev/**/*.js", ['reload']);
});

//Task by default
gulp.task('default', gulp.series('sass', 'serve', 'watch'));

/* 
IMPORTANT! For production run 'gulp prod' and then 'gulp html'.
Or just 'gulp prod; gulp html;'
*/
gulp.task('prod', gulp.series('usemin', 'images', 'root-files'));
