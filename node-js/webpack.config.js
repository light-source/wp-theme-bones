const webpackConfig = require('@lightsource/webpack-config');

webpackConfig.settings.INPUT_DIR = __dirname + '/../Blocks';
webpackConfig.settings.OUTPUT_DIR = __dirname + '/../../assets/pages';
webpackConfig.settings.SCSS_FILES = [
    ['Test/test.scss', 'test/test.min.css',],
];
webpackConfig.settings.JS_FILES = [
    ['Test/test.js', 'test/test.min.js',],
];
webpackConfig.settings.defaults.alias = {
    // force using full vue with runtime compiler (see https://ru.vuejs.org/v2/guide/installation.html)
    vue: 'vue/dist/vue.esm.browser.min.js',
};

let config = new webpackConfig.Config();
module.exports = config.exports.bind(config);
