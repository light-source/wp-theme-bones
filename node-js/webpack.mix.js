let laravelMix = require('laravel-mix')
let glob = require('glob')
let path = require('path')

class Mix {

  constructor (blocksRelativePath) {

    this.scssFiles = []
    this.tsFiles = []
    this.blocksRelativePath = blocksRelativePath
    this.blocksAbsPath = path.resolve(__dirname + '/' + this.blocksRelativePath)

    this.setupMix()
    this.readFiles()
    this.mix()

  }

  setupMix () {

    laravelMix.setPublicPath(this.blocksRelativePath)
    laravelMix.webpackConfig({
      resolve: {
        modules: [
          __dirname + '/node_modules',
        ],
      },
    })

    laravelMix.options({
      terser: {
        terserOptions: {
          // class names is required for Catalyst
          keep_classnames: /.*Element/,
          keep_fnames: /.*Element/,
        },
      },
    })

    // makes babel is dependent on package.json browserslist, so will skip additional polyfills
    laravelMix.babelConfig({
      'presets': [
        [
          '@babel/preset-env',
          {},
        ],
      ],
    })

  }

  readFiles () {

    this.scssFiles = glob.sync(this.blocksAbsPath + '/**/*.scss')
    this.tsFiles = glob.sync(this.blocksAbsPath + '/**/*.ts')
    /*   .filter((jsFileName) => {
       return (!jsFileName.match('\.min\.js') &&
           !jsFileName.match('\.json'));
   });*/

  }

  mix () {

    // will contain a list of dependencies
    laravelMix.js(this.blocksAbsPath + '/stub.js', this.blocksAbsPath + '/stub.min.js')

    this.scssFiles.forEach((absPathToScssFile, index) => {

      let absPathToMinCssFile = absPathToScssFile.replace('.scss', '.min.css')
      laravelMix.sass(absPathToScssFile, absPathToMinCssFile).options({
        autoprefixer: {
          options: {
            browsers: [
              'last 3 versions',
            ],
          },
        },
      })

    })

    this.tsFiles.forEach((absPathToTsFile, index) => {

      let absPathToMinJsFile = absPathToTsFile.replace('.ts', '.min.js')
      laravelMix.ts(absPathToTsFile, absPathToMinJsFile)

    })

  }

}

new Mix('../Blocks')
