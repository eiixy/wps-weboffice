# WPS Web Office

## 快速开始
1. 引入扩展包
```
composer require eiixy/web-office
```

2. 发布配置，注册服务
```
php artisan vendor:publish --provider="Eiixy\WebOffice\Providers\WebOfficeServiceProvider"
```

3. 添加环境变量到 `.env` 文件
```
WPS_APPID=xxxxxxxxx
WPS_APPKEY=xxxxxxxxx
```

4. 实现业务逻辑方法
    * 继承 `Eiixy\WebOffice\Services\WebOfficeHandlerService` 实现相关抽象方法
    ```php
    <?php
    namespace App\Services;
    
    use Eiixy\WebOffice\Services\WebOfficeHandlerService;
 
    class WebOfficeService extends WebOfficeHandlerService
    {
        // 实现相关业务代码....
    }
    ```
    * 在 `config/weboffice.php` 中修改 `handler` 配置
    ```php
    <?php

    return [
        // 业务处理
        'handler' => \App\Services\WebOfficeService::class,
        //.....
    ```
