const Path = require('path');
const CopyPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const IgnoreAssetsWebpackPlugin = require('ignore-assets-webpack-plugin');
// available by default in webpack
const TerserPlugin = require('terser-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;

const INPUT = '../Blocks';
const INPUT_IMAGES = '../images';

const OUTPUT = __dirname + '../../../assets';
const OUTPUT_JS = OUTPUT + '/pages';
const OUTPUT_SCSS = OUTPUT + '/pages';
const OUTPUT_IMAGES = OUTPUT + '/images';

const STUB_FILE = 'index.js';

// item : [inputFile, outputFolder ]

const JS_FILES = [
    [INPUT + '/Test/test.js', OUTPUT_JS + '/test/test.min.js',],
];
const SCSS_FILES = [
    [INPUT + '/Test/test.scss', OUTPUT_SCSS + '/test/test.min.css',],
];

/*
* Create tasks for files
* Minify only for production
* (generate source map always, because files is concat)
* */
class Config {

    constructor() {

        this._defaultTaskSettings = {
            // prevent size notify
            performance: {
                // fontawesome
                maxEntrypointSize: 1024 * 1024,
                // widget.html (with smiles)
                maxAssetSize: 2 * 1024 * 1024,
            },
            watchOptions: {
                ignored: /node_modules/,
            },
        };
        this._isProduction = false;
        this._webpackSettings = [];

        module.exports = (env, argv) => {

            this._isProduction = 'production' === argv.mode;
            this._updateDefaultTaskSettings();

            // this._static();
            this._scss();
            this._js();

            return this._webpackSettings;
        };

    }

    _updateDefaultTaskSettings() {

        /*
         * Map file contains only file-names & lines, doesn't have original code
         * (for other cases FULL original code available in browser dev tools)
         * */
        this._defaultTaskSettings.devtool = 'nosources-source-map';

        this._defaultTaskSettings.optimization = {
            minimize: this._isProduction,
            minimizer: [
                // remove comments (default target files is js)
                new TerserPlugin({
                    sourceMap: true,
                    terserOptions: {
                        output: {
                            comments: false,
                        },
                    },
                    extractComments: false,
                }),
            ],
        };

        this._defaultTaskSettings.resolve = {
            /*
            * 1. Set a correct path to a node_modules folder ( /resources/node-js/node_modules) from /resources/blocks/(*)
            * (it will be working because will recursive up by level and find node-js/node_modules instead of node_modules as default)
            * */
            modules: ["node-js/node_modules",],
        };

    }

    _scssTaskSettings(taskSettings, fileName) {

        taskSettings.module = {
            rules: [
                {
                    test: /\.scss$/i,
                    use: [
                        MiniCssExtractPlugin.loader,
                        // css to commonJs module, disable import files in url(), enable source-maps
                        {
                            loader: 'css-loader',
                            options: {
                                url: false,
                                sourceMap: true,
                            },
                        },
                        // postcss : precss + autoprefix
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: true,
                                plugins: function () {
                                    return [
                                        require('autoprefixer'),
                                    ];
                                },
                            }
                        },
                        // sass to css, enable source-maps
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true,
                            },
                        },
                    ],
                },
            ],
        };
        taskSettings.plugins = [
            new MiniCssExtractPlugin({
                filename: fileName,
            }),
        ];

        return taskSettings;
    }

    _static() {

        let taskSettings = Object.assign({}, this._defaultTaskSettings);
        taskSettings.devtool = '';
        taskSettings.entry = './' + STUB_FILE;
        taskSettings.output = {
            path: OUTPUT,
            filename: STUB_FILE,
        };
        taskSettings.plugins = [
            new CopyPlugin([
                {from: INPUT_IMAGES, to: OUTPUT_IMAGES},
            ]),
            new IgnoreAssetsWebpackPlugin({
                ignore: [
                    STUB_FILE,
                ],
            }),
            new ImageminPlugin({
                // can disable in dev
                disable: false,
                test: /\.(jpe?g|png)$/i,
            })
        ];
        this._webpackSettings.push(taskSettings);

    }

    _scss() {

        SCSS_FILES.forEach((scssFile, i) => {

            let fileName = Path.basename(scssFile[1]);
            let taskSettings = Object.assign({}, this._defaultTaskSettings);

            taskSettings.entry = scssFile[0];
            taskSettings.output = {
                path: Path.dirname(scssFile[1]),
                filename: STUB_FILE,
            };

            taskSettings = this._scssTaskSettings(taskSettings, fileName);
            taskSettings.plugins.push(
                new IgnoreAssetsWebpackPlugin({
                    ignore: [
                        STUB_FILE,
                        STUB_FILE + '.map',
                    ],
                }),
            );

            this._webpackSettings.push(taskSettings);

        });

    }

    _js() {

        JS_FILES.forEach((jsFile, i) => {

            let taskSettings = Object.assign({}, this._defaultTaskSettings);

            taskSettings.entry = jsFile[0];
            taskSettings.output = {
                filename: Path.basename(jsFile[1]),
                path: Path.dirname(jsFile[1]),
            };
            // option if already exists on the site
            /*taskSettings.externals = {
                jquery: 'jQuery',
            };*/

            this._webpackSettings.push(taskSettings);

        });

    }

}

new Config();
