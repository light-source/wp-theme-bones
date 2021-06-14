<?php

declare(strict_types=1);

namespace WpThemeBones\Classes\Acf\Main;

defined('ABSPATH') ||
die('Constant is missing');

use WP_Post;

abstract class BaseGroup
{
    const _ROOT = '';

    /**
     * @param string $field
     * @param WP_Post|int|string|false $objectId False = a current one
     *
     * @return mixed
     */
    final public static function get(string $field, $objectId = false)
    {
        $objectId = $objectId instanceof WP_Post ?
            $objectId->ID :
            $objectId;

        return function_exists('get_field') ?
            get_field($field, $objectId) :
            null;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param WP_Post|int|string|false $objectId False = a current one
     *
     * @return void
     */
    final public static function set(string $field, $value, $objectId = false)
    {
        $objectId = $objectId instanceof WP_Post ?
            $objectId->ID :
            $objectId;

        if (! function_exists('update_field')) {
            return;
        }

        update_field($field, $value, $objectId);
    }
}
