import gulp from 'gulp';
import less from 'gulp-less';
import notify from 'gulp-notify';
import plumber from 'gulp-plumber';
import gutil from 'gulp-util';
import webpack from 'webpack';
import path from 'path';
import WebpackNotifierPlugin from 'webpack-notifier';
import livereload from 'gulp-livereload';
import connect from 'gulp-connect';
import cleanCSS from 'gulp-clean-css';

gulp.task('connect', () => {
  connect.server({
    root: './assets/dist',
    port: 8000,
    livereload: true,
  });
});
// webpack normal mode config
const config = {
  color: true,
  progress: true,
  watch: true,
  devtool: 'source-map',
  debug: true,
  entry: {
    'scripts.js': './assets/src/js/scripts.js',
  },
  output: {
    path: './assets/dist/turbo/js/',
    filename: '[name]',
  },
  resolve: {
    extensions: ['', '.js', '.json'],
  },
  module: {
    loaders: [
      { test: /\.js$/,
       loader: 'babel-loader',
        query: {
          presets: ['es2015', 'stage-0', 'react'],
        },
      },
      { test: /jquery\.js$/,
        loader: 'expose?jQuery',
      },
      { test: /jquery\.js$/,
        loader: 'expose?$',
      },
      { test: /jquery\..*\.js/,
        loader: 'imports?$=jquery,jQuery=jquery,this=>window',
      },
    ],
  },
  plugins: [
    new WebpackNotifierPlugin({ title: 'Webpack', sound: 'Glass' }),
  ],
  exclude: [
    path.resolve(__dirname, 'node_modules'),
  ],
};
// gulp webpack task
gulp.task('webpack', () => {
  webpack(config, (err, stats) => {
    if (err) throw new gutil.PluginError('webpack', err);
    gutil.log('[webpack]', stats.toString({
    }));
  });
});
// webpack production task
gulp.task('js-minify', () => {
  config.plugins = [
    new webpack.optimize.UglifyJsPlugin(),
    new webpack.optimize.DedupePlugin(),
    new WebpackNotifierPlugin({ title: 'Webpack' }),
  ];
  config.watch = false;
  webpack(config, (err, stats) => {
    if (err) throw new gutil.PluginError('webpack', err);
    gutil.log('[webpack]', stats.toString({
    }));
  });
});

gulp.task('html', () => {
  gulp.src('./assets/dist/**/*.html')
  .pipe(livereload());
});
// Error handler for less
const errorAlert = (error) => {
  notify.onError({ title: 'Gulp Compiled Error', message: 'Check your terminal', sound: 'Sosumi' })(error);
  this.emit('end');
};
// gulp less task
gulp.task('less-turbo', () => {
  return gulp.src('./assets/src/less/turbo/turbo.style.less')
  .pipe(plumber({ errorHandler: notify.onError('Error: <%= error.message %>') }))
  .pipe(less())
  .pipe(notify({
    title: 'Gulp',
    subtitle: 'success',
    message: 'less',
    sound: 'Pop',
  }))
  .pipe(gulp.dest('./assets/dist/turbo/css/'))
  .pipe(livereload());
});

gulp.task('less-common-task', () => {
  return gulp.src('./assets/src/less/common.style.less')
  .pipe(plumber({ errorHandler: notify.onError('Error: <%= error.message %>') }))
  .pipe(less())
  .pipe(notify({
    title: 'Gulp',
    subtitle: 'success',
    message: 'less common task',
    sound: 'Pop',
  }))
  .pipe(livereload());
});

gulp.task('minify-css', function() {
  return gulp.src('./assets/dist/turbo/css/turbo.style.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest('./assets/dist/turbo/css/'));
});

// watch task
gulp.task('watch', () => {
  livereload.listen();
  gulp.watch('./assets/src/less/**/*.less', ['less-common-task', 'less-turbo']);
  gulp.watch('./assets/dist/**/*.html', ['html']);
});
// webpack production task
gulp.task('production', ['js-minify', 'minify-css']);
// default task
gulp.task('default', ['watch', 'less-common-task', 'less-turbo', 'webpack', 'html']);

