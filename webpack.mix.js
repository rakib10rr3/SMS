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

//js('resources/assets/js/app.js', 'public/js')
// js('resources/assets/js/app.js',
//     'public/vendors/scripts')


mix.js([
    'resources/assets/js/app.js',
    // 'public/src/scripts/moment.js',
    // 'public/src/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.js',
    'public/src/plugins/wysihtml5-master/dist/wysihtml5-0.3.0.js',
    'public/src/plugins/bootstrap-wysihtml5-master/dist/bootstrap-wysihtml5-0.0.2.js',
    'public/src/plugins/air-datepicker/dist/js/datepicker.js',
    'public/src/plugins/air-datepicker/dist/js/i18n/datepicker.en.js',
    'public/src/plugins/timedropper/timedropper.js',
    'public/src/plugins/highlight.js/src/highlight.pack.js',
    // 'public/src/plugins/select2/dist/js/select2.full.js',
    'public/src/plugins/bootstrap-select/js/bootstrap-select.js',
    // 'public/src/scripts/clipboard.min.js',
], 'public/vendors/scripts/script.js')

    .js('public/src/scripts/setting.js',
        'public/vendors/scripts/setting.js')

    .sass('resources/assets/sass/app.scss', 'public/css')

    .styles([
        // 'public/src/plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css',
        'public/src/fonts/font-awesome/css/font-awesome.min.css',
        'public/src/plugins/air-datepicker/dist/css/datepicker.css',
        'public/src/plugins/timedropper/timedropper.css',
        'public/src/plugins/highlight.js/src/styles/solarized-dark.css',
        // 'public/src/plugins/select2/dist/css/select2.css',
        'public/src/plugins/bootstrap-select/dist/css/bootstrap-select.css',
        'public/src/styles/style.css',
        'public/src/styles/media.css',
        'resources/assets/css/custom.css',
    ], 'public/vendors/styles/style.css');

