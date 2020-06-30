<?php


namespace Eiixy\WebOffice\Http\Controllers;


use Eiixy\WebOffice\Exceptions\WebOfficeException;
use Eiixy\WebOffice\WebOffice;
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
        $signature = Arr::pull($params, '_w_signature');
        $webOffice->chackSign($params, $signature);
        $file_id = Arr::get($params, '_w_fileid');
        if ($file_id != $this->file_id) {
            throw new WebOfficeException('file_id 不匹配', -1);
        }
    }

    // 获取文件元数据
    public function fileInfo(Request $request)
    {
        $permission = $request->query('_w_permission', 'read');
        $user_acl = WebOffice::decode($request->query('_w_user_acl'));
        $watermark = WebOffice::decode($request->query('_w_watermark'));
        $file_id = $request->query('_w_file_id');

        if ($file_id != $this->file_id) {
            throw new WebOfficeException('file_id 校验异常');
        }

        $auth = $this->webOffice->authUser($this->token)->setPermission($permission)->toArray();
        $file = $this->webOffice->fileInfo($this->file_id)->setWatermark($watermark)->setUserAcl($user_acl)->toArray();
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
        $this->webOffice->online();
        return response(null, 200);
    }


    // 上传文件新版本
    public function save(Request $request)
    {
        $file = $request->file('file');
        $user = $this->webOffice->authUser($this->token);
        $file = $this->webOffice->save($this->file_id, $file, $user->id);
        return response()->json([
            'file' => $file->toArray()
        ]);
    }

    // 获取特定版本的文件信息
    public function version($version)
    {
        $file = $this->webOffice->version($this->file_id, $version);
        return response()->json([
            'file' => $file
        ]);
    }

    // 文件重命名
    public function rename(Request $request)
    {
        $name = $request->input('name');
        $file_id = $request->query('file_id');
        $res = $this->webOffice->rename($this->file_id, $name);
        return response(null, 200);
    }

    // 获取所有历史版本文件信息
    public function history(Request $request)
    {
        $offset = $request->input('offset');
        $count = $request->input('count');
        $histories = $this->webOffice->history($this->file_id, $offset, $count);
        return response()->json(['histories'=>$histories]);
    }

    // 新建文件
    public function new($file_id, $file)
    {
        $user = $this->webOffice->authUser($this->token);
        $file = $this->webOffice->new($file_id, $file, $user->id);
        return [
            'redirect_url' => $this->webOffice->getFileUrl($file,$user->id,'read'),
            'user_id' => $user->id
        ];
    }

    // 回调通知
    public function onNotify()
    {
    }
}
