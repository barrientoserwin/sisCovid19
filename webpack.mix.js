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

mix.styles([
    'resources/lib/sistema/css/font-awesome.min.css',
    'resources/lib/sistema/css/simple-line-icons.min.css',
    'resources/lib/sistema/css/style.css'
], 'public/css/sistema.css')
.scripts([
    'resources/lib/sistema/js/jquery.min.js',
    'resources/lib/sistema/js/popper.min.js',
    'resources/lib/sistema/js/bootstrap.min.js',
    'resources/lib/sistema/js/Chart.min.js',
    'resources/lib/sistema/js/pace.min.js',
    'resources/lib/sistema/js/template.js',
    'resources/lib/sistema/js/sweetalert2.all.js'
], 'public/js/sistema.js')
.js(['resources/js/app.js'],'public/js/app.js');

mix.js(['resources/js/pagina.js'],'public/js/pagina.js').

styles(['resources/lib/pagina/css/style.css',
'resources/lib/pagina/css/font-awesome.min.css',
'resources/lib/pagina/css/bootstrap.min.css',
'resources/lib/pagina/css/main.css',
],
 'public/css/lib.css')
 .scripts([
    'resources/lib/pagina/js/pagina.js',
], 'public/js/lib.js')