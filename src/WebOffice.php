<?php


namespace Eiixy\WebOffice;


class WebOffice
{
    /**
     * 解码
     * @param string $string
     * @return mixed
     */
    public static function decode(string $string)
    {
        return json_decode(base64_decode($string), true);
    }

    /**
     * 编码
     * @param array $data
     * @return string
     */
    public static function encode(array $data)
    {
        return base64_encode(json_encode($data));
    }

    /**
     * 获取
     * @param File $file
     */
    public static function getUrl(File $file, $user_id)
    {
        return [
            '_w_file_id=' . $file->id,
            '_w_auth_id=' . $user_id
        ];
    }

}
