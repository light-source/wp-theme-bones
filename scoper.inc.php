<?php

use Isolated\Symfony\Component\Finder\Finder;

// in the root folder
// cd vendors; composer update; cd ..; vendors/vendor/bin/php-scoper add-prefix --output-dir Vendors; cd Vendors; composer dump-autoload

return [
	// self namespace should be defined, because otherwise will have changed in composer files and will break 'dump-autoload'
	'whitelist' => [
		'WpThemeBones\*',
	],
	'prefix'    => 'WpThemeBones\\Vendors',
	'finders'   => [
		Finder::create()->files()->in( 'vendors' )
		      ->exclude( [
			      'vendor-bin',
		      ] ),
	],
];
