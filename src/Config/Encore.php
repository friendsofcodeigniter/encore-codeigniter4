<?php


namespace Friendsofcodeigniter\Encore\Config;

use CodeIgniter\Config\BaseConfig;

class Encore extends BaseConfig
{
    public ?string $output_path = FCPATH . 'build';

    public array $script_attributes = [
        'defer' => true,

    ];

    public array $link_attributes = [];

    public ?string $crossorigin = null;

    public bool $strict_mode = false;

    public array $builds = [];
}
