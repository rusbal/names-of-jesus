const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(mix => {

    mix.sass('app.scss')
       .webpack([
           'app.js', 
           'arrownextfield.jquery.js',
           'helpers/delete-form.js',
           'helpers/btn-danger-hover.js'
       ], 'public/js/app.js');

    mix.version(['public/css/app.css',
                 'public/js/app.js']);
});
