<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\Settings as BemBlocksSettings;
use LightSource\Log\LOG;

use WpThemeBones\Std\ACTIONS;

include_once 'vendors/vendor/autoload.php';

//// settings

ini_set( 'error_log', __DIR__ . '/Logs/php.log' );

LOG::$PathToLogDir = __DIR__ . '/Logs';

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


