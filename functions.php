<?php

// using a custom constant with the check to support tests (so can be filled in a bootstrap file)
if (! defined('WP_THEME_BONES')) {
    define('WP_THEME_BONES', '1');
}

use LightSource\Log\LOG;
use WpThemeBones\Classes\Actions;

include_once __DIR__ . '/vendors/vendor/autoload.php';

//////// settings

//// log

const LOGS_FOLDER = __DIR__ . '/Logs';

if (! is_dir(LOGS_FOLDER)) {
    mkdir(LOGS_FOLDER);
}

// error_reporting( E_ALL );
ini_set('error_log', __DIR__ . '/Logs/php.log');

LOG::$PathToLogDir = LOGS_FOLDER;

//// webp

add_action(
    'init',
    function () {
        if (! apply_filters('webpconverter__is_active', false)) {
            return;
        }

        do_action(
            'webpconverter__setup_settings',
            [
                'errorCallback' => function ($errors) {
                    $logMessage   = 'WebPConverter error';
                    $logDebugArgs = [
                        '$errors' => $errors,
                    ];
                    LOG::Write(LOG::WARNING, $logMessage, $logDebugArgs);
                },
            ]
        );
    }
);

//// actions

Actions::setHooks();
