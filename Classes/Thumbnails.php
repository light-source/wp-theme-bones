<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('WP_THEME_BONES') ||
die('Constant is missing');

abstract class Thumbnails
{
    const THUMBNAIL = 'thumbnail'; // 500
    const MEDIUM = 'medium';  // 768
    const LARGE = 'large';  // 1920
    const FULL = 'full';

    public static function filterImageSizes(array $sizes): array
    {
        return array_diff(
            $sizes,
            [
                '1536x1536',
                '2048x2048',
                'medium_large',
            ]
        );
    }

    public static function setupDefaults(): void
    {
        // default wp sizes don't optimal (e.g. thumbnail is too small) and redundant (e.g. medium_large)

        update_option('thumbnail_size_w', 500);
        update_option('thumbnail_size_h', 0);

        update_option('medium_size_w', 768);
        update_option('medium_size_h', 0);

        update_option('medium_large_size_w', 0);
        update_option('medium_large_size_h', 0);

        update_option('large_size_w', 1920);
        update_option('large_size_h', 0);
    }

    public static function imageSizeThreshold(int $threshold, array $imageSizes, string $file, int $attachmentId): bool
    {
        $threshold = false; // don't need

        return $threshold;
    }
}
