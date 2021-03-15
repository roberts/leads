const mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix.sass('resources/scss/app.scss', 'dist/css')
    .tailwind();
