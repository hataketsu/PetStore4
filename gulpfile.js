var elixir = require('laravel-elixir');


elixir(mix => {
    mix
    .copy('semantic/dist/semantic.min.css', 'public/css/semantic.min.css')
    .copy('semantic/src/themes/default/assets', 'public/css/themes/default/assets')
    .copy('semantic/dist/semantic.min.js', 'public/js/semantic.min.js');
});