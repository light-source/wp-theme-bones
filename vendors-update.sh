#!/bin/bash

if [ -d "Vendors" ]; then
rm Vendors -r
fi

cd vendors
composer update
cd ..
vendors/vendor/bin/php-scoper add-prefix --output-dir Vendors
cd Vendors
composer dump-autoload
