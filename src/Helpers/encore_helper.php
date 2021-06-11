<?php

use Friendsofcodeigniter\Encore\Config\Services;

if (! function_exists('encore_entry_js_files')) {

    function encore_entry_js_files(string $entryName, string $entrypointName = '_default'): array
    {
        return Services::encore()->getJavaScriptFiles($entryName,$entrypointName);
    }
}

if (! function_exists('encore_entry_css_files')) {

    function encore_entry_css_files(string $entryName, string $entrypointName = '_default'): array
    {
        return Services::encore()->getCssFiles($entryName, $entrypointName);
    }
}

if (! function_exists('encore_entry_script_tags')) {

    function encore_entry_script_tags(string $entryName, string $entrypointName = '_default', array $attributes = []): string
    {
        return Services::encore()->renderScriptTags($entryName, $entrypointName, $attributes);
    }
}

if (! function_exists('encore_entry_link_tags')) {

    function encore_entry_link_tags(string $entryName, string $entrypointName = '_default', array $attributes = []): string
    {
        return Services::encore()->renderLinkTags($entryName, $entrypointName, $attributes);
    }
}


if (! function_exists('encore_asset')) {

    function encore_asset(): string
    {
        return '';
    }
}
