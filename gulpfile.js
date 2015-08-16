var elixir = require('laravel-elixir');
var dir = {
    'bower': '../bower/',
    'coreJs': 'core/'
};
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.sass('app.scss');

    /* Admin Stylesheets */
    mix.styles([
       dir.bower + 'bootstrap/dist/css/bootstrap.css',
       dir.bower + 'fontawesome/css/font-awesome.css',
       dir.bower + 'semantic-ui-loader/loader.css',
       dir.bower + 'nanoscroller/bin/css/nanoscroller.css',
       'materialadmin.css',
       'material-design-iconic-font.css'
    ], 'public/css/vendor.css');

    /* Admin Scripts */
    mix.scripts([
        dir.bower + 'jquery/dist/jquery.js',
        dir.bower + 'jquery-migrate/jquery-migrate.js',
        dir.bower + 'bootstrap/dist/js/bootstrap.js',
        dir.bower + 'nanoscroller/bin/javascripts/jquery.nanoscroller.js',
        dir.bower + 'jquery-autosize/dist/autosize.js',
        dir.bower + 'toastr/toastr.js',
        dir.coreJs + 'App.js',
        dir.coreJs + 'AppNavigation.js',
        dir.coreJs + 'AppOffcanvas.js',
        dir.coreJs + 'AppCard.js',
        dir.coreJs + 'AppForm.js',
        dir.coreJs + 'AppNavSearch.js',
        dir.coreJs + 'AppVendor.js'
    ], 'public/js/vendor.js');

    // Copy Fonts
    mix.copy('./resources/assets/bower/fontawesome/fonts/*.*', './public/fonts');
    mix.copy('./resources/assets/fonts/*.*', './public/fonts');

    /* Public Stylesheets */
    mix.styles([
        dir.bower + 'bootstrap/dist/css/bootstrap.css',
        dir.bower + 'fontawesome/css/font-awesome.css',
        'public/base.css',
        'public/skeleton.css',
        'public/2_corporate.css',
        'public/layout_2.css',
        'public/box.css',
    ], 'public/css/public.css');

    /* Public Scripts */
    mix.scripts([
        dir.bower + 'jquery/dist/jquery.js',
        dir.bower + 'bootstrap/dist/js/bootstrap.js',
        'public/vendor/jquery.easing.1.3.js',
        'public/vendor/custom.js',
        'public/vendor/smoothscroll.min.js',
        'public/vendor/appear.min.js',
        'public/vendor/animations.min.js'
    ], 'public/js/public.js');

    mix.copy('./resources/assets/images/public/**/*', './public/images');

});
