let laravelMix = require('laravel-mix');
let glob = require('glob');
let path = require("path");

// todo
//  remove overhead webpack/babel code

class Mix {

    constructor(blocksRelativePath) {

        this._scssFiles = [];
        this._jsFiles = [];
        this._blocksRelativePath = blocksRelativePath;
        this._blocksAbsPath = path.resolve(__dirname + '/' + this._blocksRelativePath);

        this._setupMix();
        this._readFiles();
        this._mix();

    }

    _setupMix() {

        laravelMix.setPublicPath(this._blocksRelativePath);
        laravelMix.webpackConfig({
            resolve: {
                modules: [
                    __dirname + '/node_modules'
                ],
            },
        });

        laravelMix.options({
            terser: {
                terserOptions: {
                    // class names is required for Catalyst
                    keep_classnames: /.*Element/,
                    keep_fnames: /.*Element/,
                },
            },
        });

        // makes babel is dependent on package.json browserslist, so will skip additional polyfills
        laravelMix.babelConfig({
            "presets": [
                [
                    "@babel/preset-env",
                    {}
                ]
            ]
        });

    }

    _readFiles() {

        this._scssFiles = glob.sync(this._blocksAbsPath + "/**/*.scss");
        this._jsFiles = glob.sync(this._blocksAbsPath + "/**/*.ts");
        /*   .filter((jsFileName) => {
           return (!jsFileName.match('\.min\.js') &&
               !jsFileName.match('\.json'));
       });*/

    }

    _mix() {

        this._scssFiles.forEach((absPathToScssFile, index) => {

            let absPathToMinCssFile = absPathToScssFile.replace('.scss', '.min.css');
            laravelMix.sass(absPathToScssFile, absPathToMinCssFile).options({
                autoprefixer: {
                    options: {
                        browsers: [
                            'last 2 versions',
                        ],
                    },
                },
            });

        });

        this._jsFiles.forEach((absPathToJsFile, index) => {

            let absPathToMinJsFile = absPathToJsFile.replace('.ts', '.min.js');
            laravelMix.ts(absPathToJsFile, absPathToMinJsFile);

        });

    }

}

new Mix("../Blocks");
