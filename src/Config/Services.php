<?php

namespace Friendsofcodeigniter\Encore\Config;

use CodeIgniter\Config\BaseService;
use Friendsofcodeigniter\Encore\Encore;

class Services extends BaseService
{
    public static function encore($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('encore');
        }

        return new Encore(config('Encore'));
    }
}
