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
        'resources/css/select2.css',
        ], 'public/css/app.css');
mix.js(['resources/js/app.js',
        'resources/js/bootstrap.min.js',
        ], 'public/js/app.js')
    .copy(['resources/js/noti.js',
    ], 'public/js/noti.js')
    .copy(['resources/js/thumbnail.js',
    ], 'public/js/thumbnail.js')
    .copy(['resources/js/select2.js',
    ], 'public/js/select2.js')
    .copy(['resources/js/noti_client.js',
    ], 'public/js/noti_client.js')
    .copy(['resources/js/jquery.min.js',
    ], 'public/js/jquery.js')
    .copy(['resources/js/pusher.js',
    ], 'public/js/pusher.js')
    .copy(['resources/js/ajax.js',
    ], 'public/js/ajax.js');
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/img', 'public/img');     
