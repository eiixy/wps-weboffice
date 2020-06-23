<?php


namespace Eiixy\WebOffice;


class File
{
    public $id;
    public $name;
    public $version;
    public $size;
    public $creator;
    public $create_time;
    public $modifier;
    public $modify_time;
    public $download_url;

    public $user_acl;
    public $watermark;

    /**
     * @param int $rename 重命名
     * @param int $history 历史版本
     * @param int $copy 复制
     * @param int $export 导出PDF
     * @param int $print 打印
     */
    public function setUserAcl($rename = 0, $history = 1, $copy = 1, $export = 1, $print = 1)
    {
        $this->user_acl = [
            'rename' => $rename,
            'history' => $history,
            'copy' => $copy,
            'export' => $export,
            'print' => $print,
        ];
        return $this;
    }

    /**
     * @param int $type 水印类型， 0为无水印； 1为文字水印
     * @param string $value 文字水印的文字
     * @param string $fillstyle 水印的透明度
     * @param string $font 水印的字体
     * @param int $rotate 水印的旋转度
     * @param int $horizontal 水印水平间距
     * @param int $vertical 水印垂直间距
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
        $this->watermark = [
            'type' => $type,
            'value' => $value,
            'fillstyle' => $fillstyle,
            'font' => $font,
            'rotate' => $rotate,
            'horizontal' => $horizontal,
            'vertical' => $vertical,
        ];
        return $this;
    }

    public function toArray()
    {
        $file = [
            'id' => $this->id,
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
        return $file;
    }
}

