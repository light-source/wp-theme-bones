<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\Log\LOG;

use WpThemeBones\Std\ACTIONS;

include_once 'vendors/vendor/autoload.php';

LOG::$PathToLogDir = __DIR__ . DIRECTORY_SEPARATOR . 'Logs';

ACTIONS::SetHooks();

ini_set( 'error_log', __DIR__ . '/Logs/php.log' );
