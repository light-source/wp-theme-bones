<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('ABSPATH') ||
die('Constant is missing');

abstract class Block extends \LightSource\FrontBlocks\Block
{

    const _AJAX_PREFIX = Theme::_NAME . '_block__';

    protected static function _IsSupportAjax(): bool
    {
        return false;
    }

    final public static function GetName(): string
    {
        // used static for child support
        $fullClassName = static::class;
        $nameParts     = explode('\\', $fullClassName);

        if (count($nameParts) > 1) {
            // remove global namespace
            $nameParts = array_slice($nameParts, 1);
        }

        return strtolower(implode('_', $nameParts));
    }

    final public static function GetAjaxName(): string
    {
        // used static for child support
        return self::_AJAX_PREFIX . static::GetName();
    }

    public static function AjaxCallback(): void
    {
    }

    public static function onLoad(): void
    {
        parent::onLoad();

        // below used static for child support

        if (static::_IsSupportAjax()) {
            $ajaxName = static::GetAjaxName();
            add_action("wp_ajax_" . $ajaxName, [static::class, 'AjaxCallback',]);
            add_action(
                "wp_ajax_nopriv_" . $ajaxName,
                [
                    static::class,
                    'AjaxCallback',
                ]
            );
        }
    }

}
