let laravelMix = require('laravel-mix');
let glob = require('glob');
let path = require("path");

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

    }

    _readFiles() {

        this._scssFiles = glob.sync(this._blocksAbsPath + "/**/*.scss");
        this._jsFiles = glob.sync(this._blocksAbsPath + "/**/*.js").filter((jsFileName) => {
            return (!jsFileName.match('\.min\.js') &&
                !jsFileName.match('\.json'));
        });

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

            let absPathToMinJsFile = absPathToJsFile.replace('.js', '.min.js');
            laravelMix.js(absPathToJsFile, absPathToMinJsFile);

        });

    }

}

new Mix("../Blocks");
