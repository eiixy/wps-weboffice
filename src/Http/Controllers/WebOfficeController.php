<?php


namespace Eiixy\WebOffice\Http\Controllers;


use Eiixy\WebOffice\WebOfficeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WebOfficeController
{
    private $token;
    private $file_id;
    private $webOffice;

    public function __construct(WebOfficeInterface $webOffice)
    {
        $this->webOffice = $webOffice;
        $this->token = \request()->header('x-wps-weboffice-token');
        $this->file_id = \request()->header('x-weboffice-file-id');
        $params = \request()->query();
        $signature = Arr::pull($params,'_w_signature');
        $webOffice->chackSign($params,$signature);
    }

    // 获取文件元数据
    public function fileInfo()
    {
        $auth = $this->webOffice->authUser($this->token)->setPermission('read')->toArray();
        $file = $this->webOffice->fileInfo($this->file_id)->toArray();
        return response()->json(['file' => $file, 'user' => $auth]);
    }

    // 获取用户信息
    public function userInfo(Request $request)
    {
        $ids = $request->input('ids', []);
        $users = $this->webOffice->UserInfo($ids);
        return response()->json([
            'users' => $users
        ]);
    }

    // 通知此文件目前有哪些人正在协作
    public function online()
    {
        return response(null, 200);
    }


    // 上传文件新版本
    public function save(Request $request)
    {
        $file = $request->file('file');
        $file = $this->webOffice->save($this->file_id, $file);
        return response()->json([
            'file' => $file
        ]);
    }

    // 获取特定版本的文件信息
    public function version($version)
    {
        $file = $this->webOffice->fileInfo($this->file_id, $version);
        return response()->json([
            'file' => $file
        ]);
    }

    // 文件重命名
    public function rename(Request $request)
    {
        $name = $request->input('name');
        $this->webOffice->rename($this->file_id, $name);
        return response(null, 200);
    }

    // 获取所有历史版本文件信息
    public function history(Request $request)
    {
        $offset = $request->input('offset');
        $count = $request->input('count');
        $history = $this->webOffice->history();
    }

    // 新建文件
    public function new($file_id,$file)
    {
        $file = $this->webOffice->new($file_id,$file,$name);
        return $this->webOffice->authUser()->id;
    }

    // 回调通知
    public function onNotify()
    {
    }
}
