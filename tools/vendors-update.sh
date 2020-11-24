#!/bin/bash

pathToVendors=$PWD"/../Vendors"
pathToOriginVendors=$PWD"/../vendors"
pathToTwigFixTool=$PWD"/twig-fix.php"
pathToScoperConfig=$PWD"/scoper.inc.php"

# rm the previous Vendors files

if [ -d $pathToVendors ]; then
  rm $pathToVendors -r
fi

# update & make the prefix

cd $pathToOriginVendors
composer update

vendor/bin/php-scoper add-prefix --config $pathToScoperConfig --output-dir $pathToVendors

# dump-autoload

cd $pathToVendors
composer dump-autoload

# twig fix

php $pathToTwigFixTool
