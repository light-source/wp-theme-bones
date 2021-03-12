<?php

// using a custom constant with the check to support tests (so can be filled in a bootstrap file)
if ( ! defined( 'WP_THEME_BONES' ) ) {
	define( 'WP_THEME_BONES', '1' );
}

use LightSource\Log\LOG;
use LightSource\BemBlocks\Settings as BemBlocksSettings;

use WpThemeBones\Classes\ACTIONS;

include_once __DIR__ . '/vendors/vendor/autoload.php';

//////// settings

//// logs

const LOGS_FOLDER  = __DIR__ . '/Logs';

if ( ! is_dir( LOGS_FOLDER ) ) {
	mkdir( LOGS_FOLDER );
}

// error_reporting( E_ALL );
ini_set( 'error_log', __DIR__ . '/Logs/php.log' );

LOG::$PathToLogDir = LOGS_FOLDER;

//// bemBlocks

$bemBlocksSettings = BemBlocksSettings::Instance();
$bemBlocksSettings->setBlocksDirPath( __DIR__ . '/Blocks' );
$bemBlocksSettings->setBlocksDirNamespace( 'WpThemeBones\Blocks' );
$bemBlocksSettings->setErrorCallback( function ( $errors ) {

	$logMessage   = 'Bem blocks error';
	$logDebugArgs = [
		'$errors' => $errors,
	];
	LOG::Write( LOG::WARNING, $logMessage, $logDebugArgs );

} );


////

ACTIONS::SetHooks();


