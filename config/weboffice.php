<?php

return [
    'appid' => env('WPS_APPID'),
    'appkey' => env('WPS_APPKEY'),
    // 业务处理
    'handler' => \App\Services\WebOfficeService::class,
    'domains' => [
        /**
         * 文档查看地址
         */
        'view' => env('WPS_DOMAINS_VIEW', 'https://wwo.wps.cn/office'),
    ],
    /**
     * 文件格式
     */
    'file_formats' => [
        's' => [
            'r' => ['xls', 'xlt', 'et', 'xlsx', 'xltx', 'csv', 'xlsm', 'xltm'],
            'w' => ['xls', 'xlt', 'et', 'xlsx', 'xltx', 'csv', 'xlsm', 'xltm']
        ],
        'w' => [
            'r' => ['doc', 'dot', 'wps', 'wpt', 'docx', 'dotx', 'docm', 'dotm'],
            'w' => ['doc', 'dotx', 'txt', 'dot', 'wps', 'wpt', 'docx', 'docm', 'dotm']
        ],
        'p' => [
            'r' => ['ppt', 'pptx', 'pptm', 'ppsx', 'ppsm', 'pps', 'potx', 'potm', 'dpt', 'dps'],
            'w' => ['ppt', 'pptx', 'pptm', 'ppsx', 'ppsm', 'pps', 'potx', 'potm', 'dpt', 'dps']
        ],
        'f' => [
            'r' => ['pdf'],
            'w' => ['pdf']
        ]
    ]
];
