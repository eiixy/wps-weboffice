<?php

// wps 回调接口
Route::group(['prefix' => 'v1/3rd', 'namespace' => 'Eiixy\WebOffice\Http\Controllers'], function () {
    Route::get('file/info', 'WebOfficeController@fileInfo');                // 获取文件元数据
    Route::post('user/info', 'WebOfficeController@userInfo');               // 获取用户信息
    Route::post('file/save', 'WebOfficeController@save');                   // 上传文件新版本
    Route::post('file/online', 'WebOfficeController@online');               // 通知文件有那些人在协作协作
    Route::get('file/version/{version}', 'WebOfficeController@version');    // 获取特定版本的文件信息
    Route::put('file/rename', 'WebOfficeController@rename');                // 文件重命名
    Route::post('file/history', 'WebOfficeController@history');             // 获取所有历史版本文件信息
    Route::post('file/new', 'WebOfficeController@history');                 // 新建文件
    Route::post('onnotify', 'WebOfficeController@onNotify');                // 通知
});
