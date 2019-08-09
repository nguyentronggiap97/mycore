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

mix.webpackConfig({
      resolve: {
         extensions: ['.js', '.vue', '.json'],
         alias: {
            // '@': `${__dirname}/resources/admin`,
            // '@root': `${__dirname}/resources/admin`,
            // '@app': `${__dirname}/resources/admin`,
            // '@admin': `${__dirname}/resources/admin`,
            // '@views': `${__dirname}/resources/admin/views`,
            // '@pages': `${__dirname}/resources/admin/pages`,
            // '@store': `${__dirname}/resources/admin/store`,
            // '@helpers': `${__dirname}/resources/admin/helpers`,
            // '@layouts': `${__dirname}/resources/admin/layouts`,
            // '@services': `${__dirname}/resources/admin/services`,
            // '@components': `${__dirname}/resources/admin/components`,
         },
      },
   })
   .js('resources/admin/app.js', 'public/assets/js')
   .sass('resources/sass/app.scss', 'public/assets/css');
