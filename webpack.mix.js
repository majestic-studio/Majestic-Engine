const mix = require('laravel-mix')
const path = require('path')
const outPat = path.join(__dirname, '../Content/Themes/Frontend/default/assets/')

mix.js('resources/js/app.js', outPat + '/js').vue();
mix.sass('resources/sass/app.sass', outPat + '/css');
