<?php

namespace Friendsofcodeigniter\Encore;

use Friendsofcodeigniter\Encore\Config\Encore AS EncoreConfig;
use RuntimeException;
use function file_get_contents;
use function json_decode;

class Encore
{
    private const ENTRYPOINTS_FILE_NAME = 'entrypoints.json';
    private const MANIFEST_FILE_NAME = 'manifest.json';

    public EncoreConfig $config;

    protected array $entrypoints = [];

    public function __construct(EncoreConfig $config)
    {
        $this->config = $config;

    }

    protected function getBuildPath($entrypointName) : string {
        if($entrypointName === '_default') {
            return rtrim($this->config->output_path, '/') . '/';
        }

        if(!isset($this->config->builds[$entrypointName])) {
            throw new RuntimeException();
        }



        return rtrim($this->config->builds[$entrypointName]) . '/';
    }

    protected function getEntrypoints(string $entrypointName = '_default') : array {
        if(isset($this->entrypoints[$entrypointName])) {
            return $this->entrypoints[$entrypointName];
        }

        $file = $this->getBuildPath($entrypointName) . self::ENTRYPOINTS_FILE_NAME;

        if(!file_exists($file)) {
            throw new RuntimeException();
        }

        $content = file_get_contents($file);

        if($content === false) {
            throw new RuntimeException();
        }

        $entrypoints  = json_decode($content, true);
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new RuntimeException();
        }
        $this->entrypoints[$entrypointName] = $entrypoints;
        return $this->entrypoints[$entrypointName];
    }

    protected function getManifest(string $entrypointName = '_default') {

    }

    public function getJavaScriptFiles(string $entryName, string $entrypointName = '_default') : array {
        $entrypoints = $this->getEntrypoints($entrypointName);
        if(!isset($entrypoints['entrypoints'][$entryName]['js'])) {
            return [];
        }

        return $entrypoints['entrypoints'][$entryName]['js'];
    }

    public function getCssFiles(string $entryName, string $entrypointName = '_default') : array {
        $entrypoints = $this->getEntrypoints($entrypointName);
        if(!isset($entrypoints['entrypoints'][$entryName]['css'])) {
            return [];
        }

        return $entrypoints['entrypoints'][$entryName]['css'];
    }

    protected function renderAttributes(array $attributes) : string {
        return implode(' ', array_map(function($key) use ($attributes) {
            if(is_bool($attributes[$key])){
                    return $attributes[$key] ? $key : '';
            }

            return $key.'="'.$attributes[$key].'"';
            }, array_keys($attributes))
        );
    }

    public function renderScriptTags(string $entryName, string $entrypointName = '_default', array $attributes = []) : string {
        $files = $this->getJavaScriptFiles($entryName, $entrypointName);
        $attributes = array_merge($this->config->script_attributes,$attributes);
        $attributesRendered = $this->renderAttributes($attributes);

        $html = '';
        foreach ($files as $file) {
            $html .= '<script src="'.$file.'" '.$attributesRendered.'></script>';
        }
        return $html;
    }

    public function renderLinkTags(string $entryName, string $entrypointName = '_default', array $attributes = []): string {
        $files = $this->getCssFiles($entryName, $entrypointName);
        $attributes = array_merge($this->config->link_attributes,$attributes);
        $attributesRendered = $this->renderAttributes($attributes);

        $html = '';
        foreach ($files as $file) {
            $html .= '<link rel="stylesheet" href=""'.$file.'" '.$attributesRendered.'>';
        }
        return $html;
    }
}
