<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('ABSPATH') ||
die('Constant is missing');

use LightSource\FrontBlocks\Block as LSBlock;

abstract class Block extends LSBlock
{
    const _AJAX_PREFIX = Theme::_NAME . '_block__';

    final private static function signupAcf(): void
    {
        if (! function_exists('acf_register_block_type')) {
            return;
        }

        $acfDefaultArgs = [
            'name'            => self::getAcfName(),
            'supports'        => [
                'jsx' => true,
            ],
            'example'         => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        '__mini-preview' => true,
                    ],
                ],
            ],
            'render_callback' => function ($blockData, $content = '', $isPreview = false, $postId = 0) {
                $postId = (int)$postId;// for some reasons sometimes it's a string

                if (get_field('__mini-preview')) {
                    $preview = self::getResourceUrl('.png');

                    if ($preview) {
                        echo "<img src='{$preview}' alt='preview' />";
                    }

                    return;
                }

                $block = new static();
                $block->loadByGutenberg($postId);
                $classes = [self::getResourceCssName(),];

                if (isset($blockData['className']) &&
                    $blockData['className']) {
                    $classes[] = $blockData['className'];
                }

                if ($isPreview) {
                    $classes[] = 'a-preview';
                }

                $args = [
                    '_isGutenberg' => true,
                    'classes'      => $classes,
                ];

                Fb::Instance()->getRenderer()->render($block, $args, true);
            },
        ];

        // using static for child support
        $acfArgs = array_replace_recursive($acfDefaultArgs, static::getGutenbergArgs());

        acf_register_block_type($acfArgs);
    }

    final public static function getResourceUrl(string $extension): string
    {
        // using static for child support
        $relativePath = static::getResourceInfo(
                Fb::Instance()->getSettings()
            )[LSBlock::RESOURCE_KEY_RELATIVE_RESOURCE_PATH] . $extension;

        $resourcePath = get_stylesheet_directory() . '/' . Theme::FOLDER__BLOCKS . '/' . $relativePath;
        $resourceUrl  = get_stylesheet_directory_uri() . '/' . Theme::FOLDER__BLOCKS . '/' . $relativePath;

        return is_file($resourcePath) ?
            $resourceUrl :
            '';
    }

    final public static function getName(): string
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

    final public static function getAjaxName(): string
    {
        // used static for child support
        return self::_AJAX_PREFIX . static::getName();
    }

    final public static function getAcfName(): string
    {
        // for some reasons acf doesn't work with underline
        return str_replace('_', '-', self::getName());
    }

    public static function isSupportAjax(): bool
    {
        return false;
    }

    public static function isSupportGutenberg(): bool
    {
        return false;
    }

    // can be overridden for difficult cases, like JustBlockThemeMain
    public static function getResourceCssName(): string
    {
        $resourceName = static::getResourceInfo(
            Fb::Instance()->getSettings()
        )[LSBlock::RESOURCE_KEY_RESOURCE_NAME];

        $className = (array)preg_split('/(?=[A-Z])/', $resourceName, -1, PREG_SPLIT_NO_EMPTY);
        $className = implode('--', $className);

        return strtolower($className);
    }

    public static function getGutenbergArgs(): array
    {
        return [
            'title'       => static::getResourceInfo(
                Fb::Instance()->getSettings()
            )[LSBlock::RESOURCE_KEY_RESOURCE_NAME],
            'description' => '',
            'category'    => Theme::GUTENBERG_CATEGORY__BLOCKS,
        ];
    }

    public static function ajaxCallback(): void
    {
    }

    public static function onLoad(): void
    {
        parent::onLoad();

        // below used static for child support

        if (static::isSupportAjax()) {
            $ajaxName = static::GetAjaxName();
            add_action("wp_ajax_" . $ajaxName, [static::class, 'AjaxCallback',]);
            add_action(
                "wp_ajax_nopriv_" . $ajaxName,
                [
                    static::class,
                    'ajaxCallback',
                ]
            );
        }

        if (static::isSupportGutenberg()) {
            static::signupAcf();
        }
    }

    public function loadByGutenberg(int $postId, string $prefix = '')
    {
        $this->load();
    }
}
