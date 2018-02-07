let mix = require('laravel-mix');

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
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.copy('resources/assets/templates', 'public/templates');
mix.js('resources/assets/js/public/app.js', 'public/templates/public/js')
    .sass('resources/assets/sass/public/app.scss', 'public/templates/public/css');

mix.copy('resources/assets/img/sidebar-*.jpg', 'public/images')
    .copy('resources/assets/img/*.png', 'public/images');
mix.js('resources/assets/js/auth.js', 'public/js')
    .sass('resources/assets/sass/auth.scss', 'public/css');
mix.js('resources/assets/js/light-bootstrap-dashboard.js', 'public/js')
    .sass('resources/assets/sass/light-bootstrap-dashboard.scss', 'public/css');
mix.copy('node_modules/ckeditor/*.js', 'public/js/ckeditor')
    .copy('node_modules/ckeditor/*.css', 'public/js/ckeditor')
    .copy('node_modules/ckeditor/lang', 'public/js/ckeditor/lang')
    .copy('node_modules/ckeditor/plugins', 'public/js/ckeditor/plugins')
    .copy('node_modules/ckeditor/skins', 'public/js/ckeditor/skins');
mix.extract([
    'lodash', 'chartist', 'jquery',
    'bootstrap-notify', 'bootstrap-select', 'bootstrap-switch',
    'vue', 'axios'
], 'public/js/vendor.js');
mix.version();
