// JavaScript Document

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function(){
  return gulp.src('assets/css')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest('assets/scss'))
});
gulp.task('sass:watch', function(){
	gulp.watch('assets/css', ['sass']); 
});
								 
