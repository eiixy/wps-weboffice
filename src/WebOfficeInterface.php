<?php

namespace Eiixy\WebOffice;

interface WebOfficeInterface
{
    public function authUser($token): array;

    // 获取文件元数据
    public function fileInfo($file_id, $version = null, $user_acl = null, $watermark = null);

    // 获取用户信息
    public function UserInfo(array $ids): array;

    // 通知此文件目前有哪些人正在协作
    public function online();

    // 上传文件新版本
    public function save($file_id, $file): array;

    // 获取特定版本的文件信息
    public function version($file_id, $version): array;

    // 文件重命名
    public function rename($file_id, $name): array;

    // 新建文件
    public function new($file_id, $file): array;

    // 回调通知
    public function onNotify();
}
