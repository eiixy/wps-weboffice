<?php

namespace Eiixy\WebOffice;

interface WebOfficeInterface
{
    public function authUser($token): User;

    // 获取文件元数据
    public function fileInfo($file_id): File;

    // 获取用户信息
    public function UserInfo(array $ids): Users;

    // 通知此文件目前有哪些人正在协作
    public function online();

    // 上传文件新版本
    public function save($file_id, $file, $user_id): File;

    // 获取特定版本的文件信息
    public function version($file_id, $version): File;

    // 文件重命名
    public function rename($file_id, $name);

    // 获取所有历史版本文件信息
    public function history($file_id, $offset, $count);

    // 新建文件
    public function new($file_id, $file, $user_id): File;

    // 回调通知
    public function onNotify();
}
