<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('ABSPATH') ||
die('Constant is missing');

use LightSource\FrontBlocks\Renderer;
use LightSource\FrontBlocks\Settings;
use LightSource\Log\LOG;

final class Fb
{

    private static ?self $Instance = null;

    private Settings $settings;
    private Renderer $renderer;

    private function __construct()
    {
        $this->_setupSettings();
        $this->renderer = new Renderer($this->settings);
    }

    public static function Instance(): Fb
    {
        if (! self::$Instance) {
            self::$Instance = new self();
        }

        return self::$Instance;
    }

    private function _setupSettings()
    {
        $this->settings = new Settings();
        $this->settings->addBlocksFolder('WpThemeBones\Blocks', __DIR__ . '/../Blocks');
        $this->settings->setErrorCallback(
            function ($errors) {
                $logMessage   = 'Front blocks framework error';
                $logDebugArgs = [
                    '$errors' => $errors,
                ];
                LOG::Write(LOG::WARNING, $logMessage, $logDebugArgs);
            }
        );
    }

    private function __clone()
    {
    }

    public function getRenderer(): Renderer
    {
        return $this->renderer;
    }

    public function getSettings(): Settings
    {
        return $this->settings;
    }
}
