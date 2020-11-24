<?php

use Isolated\Symfony\Component\Finder\Finder;

$pathToOriginVendors = __DIR__ . '/../vendors';
$namespace           = 'WpThemeBones';
$vendorNamespace     = "{$namespace}\\Vendors";

return [
	// self namespace should be defined, because otherwise will have changed in composer files and will break 'dump-autoload'
	'whitelist' => [
		"{$namespace}\*",
	],
	'prefix'    => $vendorNamespace,
	'finders'   => [
		Finder::create()->files()->in( $pathToOriginVendors )
		      ->exclude( [
			      'vendor-bin',
		      ] ),
	],
];
