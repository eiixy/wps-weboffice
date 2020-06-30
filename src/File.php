<?php


namespace Eiixy\WebOffice;


class File
{
    public $id;
    public $uuid;
    public $name;
    public $version;
    public $size;
    public $suffix;
    public $creator;
    public $create_time;
    public $modifier;
    public $modify_time;
    public $download_url;

    public $user_acl;
    public $watermark;

    /**
     * @param array $options
     */
    public function setUserAcl($options)
    {
        $this->user_acl = array_merge([
            'rename' => 0,      // 重命名
            'history' => 1,     // 历史版本
            'copy' => 1,        // 复制
            'export' => 1,      // 导出PDF
            'print' => 1,       // 打印
        ],$options);
        return $this;
    }

    /**
     * @param array $options
     */
    public function setWatermark($options)
    {
        $this->watermark = array_merge([
            'type' => 0,                                    //水印类型， 0为无水印； 1为文字水印
            'value' => "禁止传阅",                          // 文字水印的文字
            'fillstyle' => "rgba( 192, 192, 192, 0.6 )",    // 水印的透明度
            'font' => "bold 20px Serif",                    // 水印的字体
            'rotate' => -0.7853982,                         // 水印的旋转度
            'horizontal' => 50,                             // 水印水平间距
            'vertical' => 100,                              // 水印垂直间距
        ],$options);
        return $this;
    }

    public function toArray()
    {
        $file = [
            'id' => $this->uuid,
            'name' => $this->name,
            'version' => $this->version,
            'size' => $this->size,
            'creator' => $this->creator,
            'create_time' => $this->create_time,
            'modifier' => $this->modifier,
            'modify_time' => $this->modify_time,
            'download_url' => $this->download_url,
        ];
        if ($this->user_acl){
            $file['user_acl'] = $this->user_acl;
        }
        if ($this->watermark){
            $file['watermark'] = $this->watermark;
        }

        return array_filter($file,function ($item){
           if ($item){
               return $item;
           }
        });
    }
}

