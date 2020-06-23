<?php

namespace Eiixy\WebOffice\Services;

use Eiixy\WebOffice\File;
use Eiixy\WebOffice\Files;
use Eiixy\WebOffice\User;
use Eiixy\WebOffice\Users;
use Eiixy\WebOffice\WebOfficeInterface;
use Illuminate\Support\Str;

abstract class WebOfficeHandlerService
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
     * @param int $rename   重命名
     * @param int $history  历史版本
     * @param int $copy     复制
     * @param int $export   导出PDF
     * @param int $print    打印
     */
    public function setUserAcl($rename = 0, $history = 1, $copy = 1, $export = 1, $print = 1)
    {

    }

    /**
     * @param int $type             水印类型， 0为无水印； 1为文字水印
     * @param string $value         文字水印的文字
     * @param string $fillstyle     水印的透明度
     * @param string $font          水印的字体
     * @param int $rotate           水印的旋转度
     * @param int $horizontal       水印水平间距
     * @param int $vertical         水印垂直间距
     */
    public function setWatermark(
        $type = 0, 
        $value = "禁止传阅", 
        $fillstyle = "rgba( 192, 192, 192, 0.6 )", 
        $font = "bold 20px Serif", 
        $rotate = -0.7853982, 
        $horizontal = 50, 
        $vertical = 100)
    {

    }

    /**
     * 用户操作权限
     * @params string permission write：可编辑，read：预览
     */
    public function setPermission($permission = 'read')
    {
        # code...
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
    abstract public function fileInfo($file_id, $version = null, $user_acl = null, $watermark = null):File;

    // 获取用户信息
    abstract public function UserInfo(array $ids): Users;

    // 通知此文件目前有哪些人正在协作
    abstract public function online();

    // 上传文件新版本
    abstract public function save($file_id, $file): File;

    // 获取特定版本的文件信息
    abstract public function version($file_id, $version):Files;

    // 文件重命名
    abstract public function rename($file_id, $name);

    // 新建文件
    abstract public function new($file_id, $file):File;

    // 回调通知
    abstract public function onNotify();
}
