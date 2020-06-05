<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\Log\LOG;

include_once 'vendors/vendor/autoload.php';

LOG::$PathToLogDir = __DIR__ . DIRECTORY_SEPARATOR . 'Logs';

ACTIONS::SetHooks();
