const gulp = require('gulp')

const rename = require('gulp-rename')
const concat = require('gulp-concat')
const del = require('del')
const argv = require('yargs').argv

/**
 * Env
 */

process.env.NODE_ENV = argv.env ? argv.env : 'dev'

/**
 * Clean
 */

function clean() {
  
  return del([
    './web/css',
    './web/js',
    './web/img',
  ])
  
}

exports.clean = clean

/**
 * Lint
 */

function eslint() {
  
  const eslint = require('gulp-eslint')
  
  return gulp.src([
      './web/src/js/**/*.js',
      '!./web/src/js/vendor/**/*.js',
    ])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.result(result => {
      console.log(`ESLint result: ${result.filePath}`)
      console.log(`# Messages: ${result.messages.length}`)
      console.log(`# Warnings: ${result.warningCount}`)
      console.log(`# Errors: ${result.errorCount}`)
    }))
  
}

function stylelint() {
  
  const stylelint = require('gulp-stylelint')
  
  return gulp.src([
      './web/src/scss/**/*.scss',
      '!./web/src/scss/vendor/**/*.scss',
    ])
    .pipe(stylelint({
      reporters: [{
        formatter: 'string',
        console: true 
      }]
    }))
  
}

const lint = gulp.parallel(stylelint, eslint)

/**
 * Build
 */

function styles(cb) {
  
  const sass = require('gulp-sass')
  const autoprefixer = require('gulp-autoprefixer')
  const cleanCss = require('gulp-clean-css')
              
  const task = gulp.src([
      './web/src/scss/**/*.scss',
      '!./web/src/scss/vendor/**/*.scss'
    ])
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(gulp.dest('./web/css'))

  if (process.env.NODE_ENV === 'production') {

    task.pipe(cleanCss())
      .pipe(rename({
        suffix: '.min'
      }))
      .pipe(gulp.dest('./web/css'))

  }

  cb()
  
}

function scripts(cb) {
  
  const babel = require('gulp-babel')
  const uglify = require('gulp-uglify')

  let packages = {
    'site': [
      './web/src/js/vendor/*.js',
      './web/src/js/site.js'
    ],
  }
  
  for (var package in packages) {
    
    let task = gulp.src(packages[package])
      .pipe(concat(package+'.js'))
      .pipe(gulp.dest('./web/js'))
    
    if (process.env.NODE_ENV === 'prod') {
      
      task.pipe(uglify())
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(gulp.dest('./web/js'))
      
    }
    
  }
  
  cb()

}

function images(cb) {
  
  const imagemin = require('gulp-imagemin')
  const task = gulp.src('./web/src/img/**/*')

  if (process.env.NODE_ENV === 'prod') {

    task.pipe(imagemin([
      imagemin.gifsicle({ interlaced: true }),
      imagemin.jpegtran({ progressive: true }),
      imagemin.optipng({ optimizationLevel: 5 }),
      imagemin.svgo({plugins: [{ removeViewBox: true }]})
    ]))

  }

  task.pipe(gulp.dest('./web/img'))
  
  cb()
  
}

const build = gulp.series(clean, gulp.parallel(styles, scripts, images))

/**
 * Watch
 */

function watch() {
  
  gulp.watch('./web/src/scss/**/*.scss', styles) 
  gulp.watch('./web/src/js/**/*.js', scripts)
  gulp.watch('./web/src/img/**/*', images)
    
}

/**
 * Default
 */

if (process.env.NODE_ENV === 'prod') {
  exports.default = gulp.series(lint, build)
} else {
  exports.default = gulp.series(build, watch)
}