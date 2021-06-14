<?php

declare(strict_types=1);

namespace WpThemeBones\Classes\Security;

use WpThemeBones\Classes\Theme;

defined('ABSPATH') ||
die('Constant is missing');

abstract class Htaccess
{
    const PROTECTED__EXTENSIONS = 'ftpaccess|htaccess|conf|json|lock|twig|scss|sh';
    const PROTECTED__FILES = 'log.html|readme.md';

    public static function filterContent(string $rules): string
    {
        $pathToBlockAssets = ltrim(wp_make_link_relative(Theme::GetUrl(Theme::FOLDER__BLOCKS)), '/');

        // to correct work required enabled modules : rewrite, expires, headers

        $addingContent = "\n# BEGIN " . Theme::NAME;

        //// 1. disable directory browsing

        $addingContent .= "\nOptions -Indexes";

        //// 2. lock non-public files

        $addingContent .= "\nRedirectMatch 404 /\.git";

        $addingContent .= "\n<FilesMatch '\.(" . self::PROTECTED__EXTENSIONS . ")$'>";
        $addingContent .= "\nOrder allow,deny";
        $addingContent .= "\nDeny from all";
        $addingContent .= "\n</FilesMatch>";

        $addingContent .= "\n<FilesMatch '" . self::PROTECTED__FILES . "'>";
        $addingContent .= "\nOrder allow,deny";
        $addingContent .= "\nDeny from all";
        $addingContent .= "\n</FilesMatch>";

        //// 3. protect theme resources

        // todo allow .min.js but deny .js
        /*$addingContent .= "\n<IfModule mod_rewrite.c>";
        $addingContent .= "\nRewriteEngine On";
        $addingContent .= "\nRewriteRule ^{$pathToBlockAssets}/.*\.(js)$ - [F,L]";
        $addingContent .= "\n</IfModule>";*/

        //// 4. password protect whole site

        if (false) {
            $pathToHtpasswd = ABSPATH . '../';
            $addingContent  .= "\nAuthType Basic";
            $addingContent  .= "\nAuthName 'Restricted Area'";
            $addingContent  .= "\nAuthUserFile {$pathToHtpasswd}.htpasswd";
            $addingContent  .= "\nRequire valid-user";
        }

        $addingContent .= "\n# End " . Theme::NAME . "\n\n";

        $rules = $addingContent . $rules;

        return $rules;
    }
}
