var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
     .addEntry('js/calculator', './assets/js/calculator.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')

    // uncomment if you use Sass/SCSS files
     .enableSassLoader(function(sassOptions) {}, {
         resolveUrlLoader: true
     })

    // uncomment for legacy applications that require $/jQuery as a global variable
     .autoProvidejQuery()

    .enableVueLoader()
;

module.exports = Encore.getWebpackConfig();
