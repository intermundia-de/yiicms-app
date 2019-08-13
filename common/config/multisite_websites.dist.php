<?php
/**
 * Created by PhpStorm.
 * User: zura
 * Date: 4/12/19
 * Time: 2:06 PM
 */


return [
    '*.com' => [
        'defaultContentId' => 2,
        'masterLanguage' => 'en-US',
        // Storage URL is optional
        "storageUrl" => 'http://yiicms-app.test/storage/web',
        // this will be used
        "frontendHost" => 'yiicms-app.test',
        "domains" => [
            'yiicms-app.test' => 'en-US',
            'backend.yiicms-app.test' => 'en-US',
        ]
    ],
    '*.de' => [
        'defaultContentId' => 4,
        'masterLanguage' => 'en-DE',
        "storageUrl" => 'http://yiicms-app.en/storage/web',
        "frontendHost" => 'yiicms-app.detest',
        "domains" => [
            'yiicms-app.detest' => 'de-DE',
            'backend.yiicms-app.detest' => 'en-DE',
        ],
    ],
];