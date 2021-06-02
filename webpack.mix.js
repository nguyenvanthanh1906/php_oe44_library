const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles(['resources/css/bootstrap.min.css',
        'resources/css/app.css',
        'resources/css/sidebar.css',
        ], 'public/css/app.css')
        .styles(['resources/css/gijgo.min.css',
            ], 'public/css/gijgo.css');
mix.js(['resources/js/app.js',
        'resources/js/bootstrap.min.js',
        ], 'public/js/app.js')
    .js(['resources/js/gijgo.min.js',
        ], 'public/js/gijgo.js')
    .js(['resources/js/datepicker.js',
        ], 'public/js/datepicker.js')
    .copy(['resources/js/jquery.min.js',
    ], 'public/js/jquery.js');
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/img', 'public/img');     
