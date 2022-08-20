const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.combine([
    'public/css/styles.css'
], 'public/css/all.css');

// mix.scripts(
//     [
//         'public/datetimepicker/jquery.datetimepicker.full.min.js'
//            ],    'public/js/all.js'
// );
