<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Vendors\LightSource\BemBlocks\Settings as BemBlocksSettings;
use WpThemeBones\Vendors\LightSource\Log\LOG;

use WpThemeBones\Classes\ACTIONS;

include_once __DIR__ . '/Vendors/vendor/autoload.php';

//// settings

const LOGS_FOLDER = __DIR__ . '/Logs';

if ( ! is_dir( LOGS_FOLDER ) ) {
	mkdir( LOGS_FOLDER );
}

ini_set( 'error_log', LOGS_FOLDER . '/php.log' );

LOG::$PathToLogDir = LOGS_FOLDER;


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


