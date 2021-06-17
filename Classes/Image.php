<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('WP_THEME_BONES') ||
die('Constant is missing');

use LightSource\Log\LOG;

abstract class Image
{
    const SIZE_THUMBNAIL = 'thumbnail'; // 500
    const SIZE_MEDIUM = 'medium';  // 768
    const SIZE_LARGE = 'large';  // 1920
    const SIZE_FULL = 'full';

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

    public static function filterImageSizeThreshold(
        int $threshold,
        array $imageSizes,
        string $file,
        int $attachmentId
    ): bool {
        $threshold = false; // don't need

        return $threshold;
    }

    public static function getSrcSet(int $attachmentId, ?string $maxSize = null): string
    {
        $srcSet  = [];
        $maxSize = ! $maxSize ?
            self::SIZE_LARGE :
            $maxSize;

        // thumbnail is not using, because have very bad quality

        $weights    = [
            self::SIZE_THUMBNAIL => 1,
            self::SIZE_MEDIUM    => 2,
            self::SIZE_LARGE     => 3,
            self::SIZE_FULL      => 4,
        ];
        $dimensions = [
            self::SIZE_THUMBNAIL => '768w',
            self::SIZE_MEDIUM    => '992w',
            self::SIZE_LARGE     => '1200w',
            self::SIZE_FULL      => '1400w', // usually not using
        ];

        foreach ($dimensions as $size => $dimension) {
            if (! isset($weights[$size], $weights[$maxSize])) {
                $logMessage   = 'Array key is wrong';
                $logDebugArgs = [
                    '$size'    => $size,
                    '$maxSize' => $maxSize,
                    '$weights' => $weights,
                ];
                LOG::Write(LOG::WARNING, $logMessage, $logDebugArgs);

                continue;
            }

            if ($weights[$size] > $weights[$maxSize]) {
                continue;
            }

            $src = wp_get_attachment_image_src($attachmentId, $size);

            if (! $src) {
                continue;
            }

            $srcSet[] = $src[0] . ' ' . $dimension;
        }

        return implode(', ', $srcSet);
    }

    public static function getWebPSrcSet(string $originSrcSet): string
    {
        $targetParts  = [];
        $targetSrcSet = '';

        if (! $originSrcSet ||
            ! apply_filters('webpconverter__is_active', false)) {
            return $targetSrcSet;
        }

        $originParts = explode(',', $originSrcSet);

        $isWrongSrcSet = false;

        foreach ($originParts as $originPackage) {
            $originPackage = trim($originPackage);
            $originPackage = explode(' ', $originPackage);

            if (2 !== count($originPackage)) {
                $logMessage   = 'SrcSet part is wrong';
                $logDebugArgs = [
                    '$originSrcSet' => $originSrcSet,
                ];
                LOG::Write(LOG::WARNING, $logMessage, $logDebugArgs);

                continue;
            }

            $targetUrl = apply_filters(
                'webpconverter__get_source',
                $originPackage[0],
                [
                    'isAllowWrongExtension' => true, // do not log, can be e.g. svg
                ]
            );

            // can be empty e.g. if a limit per request is filled or due to an error
            // anyway don't provide any srcSet in this case

            if (! $targetUrl) {
                $isWrongSrcSet = true;
                break;
            }

            $targetParts[] = $targetUrl . ' ' . $originPackage[1];
        }

        if ($isWrongSrcSet) {
            return $targetSrcSet;
        }

        return implode(', ', $targetParts);
    }

    public static function getCaption(int $attachmentId): string
    {
        return ($attachmentId ?
            get_post($attachmentId)->post_excerpt :
            '');
    }
}
