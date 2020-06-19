<?php

namespace Sczts\Upload\Facades;

use Eiixy\WebOffice\Services\WebOfficeService;
use Illuminate\Support\Facades\Facade;


class WebOffice extends Facade
{
    /**
     * 获取组件的注册名称。
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return WebOfficeService::class;
    }
}
