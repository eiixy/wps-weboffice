<?php

namespace Eiixy\WebOffice\Services;

use Eiixy\WebOffice\WebOfficeInterface;
use Illuminate\Support\Str;

abstract class WebOfficeHandlerService implements WebOfficeInterface
{
    private $appid;
    private $appkey;
    private $file_formats;
    private $domain;

    public function __construct()
    {
        $this->appid = config('wps.appid');
        $this->appkey = config('wps.appkey');
        $this->file_formats = config('wps.file_formats');
        $this->domain = config('wps.domains.view');
    }

    /**
     * 生成签名
     * @param $params
     * @return string
     */
    public function sign(array $params)
    {
        $params[] = '_w_appid=' . $this->appid;
        sort($params);
        $content = implode('', $params) . '_w_secretkey=' . $this->appkey;
        $signature = base64_encode(hash_hmac('sha1', $content, $this->appkey, true));
        $params[] = '_w_signature=' . urlencode($signature);
        return implode('&', $params);
    }

    /**
     * 获取查看链接
     * @param $params
     * @param $suffix
     * @param $file_id
     * @return string
     */
    public function getViewUrl($params, $suffix, $file_id)
    {
        $file_type = $this->getFileTypeCode($suffix);
        $path = $this->sign($params);
        return Str::finish($this->domain, '/') . $file_type . '/' . $file_id . '?' . $path;
    }

    /**
     * 获取文件类型编码
     * @param $suffix
     * @param null $mode 操作模式 r:读，w:写
     * @return string
     */
    public function getFileTypeCode($suffix, $mode = null)
    {
        foreach ($this->file_formats as $key => $type) {
            if ($mode != 'r' && in_array($suffix, $type['w'])) {
                return $key;
            }
            if ($mode != 'w' && in_array($suffix, $type['r'])) {
                return $key;
            }
        }
    }

    abstract public function authUser($token): array;

    // 获取文件元数据
    abstract public function fileInfo($file_id, $version = null, $user_acl = null, $watermark = null);

    // 获取用户信息
    abstract public function UserInfo(array $ids): array;

    // 通知此文件目前有哪些人正在协作
    abstract public function online();

    // 上传文件新版本
    abstract public function save($file_id, $file): array;

    // 获取特定版本的文件信息
    abstract public function version($file_id, $version): array;

    // 文件重命名
    abstract public function rename($file_id, $name): array;

    // 新建文件
    abstract public function new($file_id, $file): array;

    // 回调通知
    abstract public function onNotify();
}
