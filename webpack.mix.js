const mix = require('laravel-mix')

mix.disableSuccessNotifications()
  .js('resources/js/index.js', 'public/js')
  .sass('resources/css/app.scss', '../../../public/vendor/rambo/css')
  // .sass('resources/css/app.scss', 'public/css')

if (mix.inProduction()) {
  mix.version()
}
