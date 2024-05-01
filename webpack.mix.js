let mix = require('laravel-mix');

require('laravel-mix-tailwind');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/app-site.js', 'public/js/app-site.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/app-site.scss', 'public/css')
   .tailwind();


// mix.babel([
//       'resources/assets/videojs/videojs/video.min.js',
//       'resources/assets/videojs/videojs/lang/fa.js',
//       'resources/assets/videojs/videojs/plugins/videojs.hotkeys.min.js',
//       'resources/assets/videojs/videojs/nuevo.min.js',
//       'public/js/app-site.js',
//    ], 'public/js/app-site.js');
