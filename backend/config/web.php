<?php
$config = [
    'homeUrl' => Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => '/core/timeline-event/index',
    'defaultAlias' => 'website',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'core/site/error',
        ],
        'request' => [
            'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY'),
            'baseUrl' => env('BACKEND_BASE_URL'),
        ],
        'user' => [
            'class' => \intermundia\yiicms\web\User::class,
            'identityClass' => \intermundia\yiicms\models\User::class,
            'loginUrl' => ['core/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'css' => [
                        'css/bootstrap.min.css',
                    ]
                ],
            ],
        ],
        'ckEditorStyles' => [
            'class' => \intermundia\yiicms\components\CKEditorComponent::class,
            'customStyles' => [
            ]
        ],
    ],
    'modules' => [
        'core' => [
            'class' => \intermundia\yiicms\Module::class,
            'modules' => [
                'user' => \intermundia\yiicms\modules\user\Module::class,
                'country' => \intermundia\yiicms\modules\country\Module::class,
                'widget' => \intermundia\yiicms\modules\widget\Module::class,
                'translation' => \intermundia\yiicms\modules\translation\Module::class,
                'rbac' => \intermundia\yiicms\modules\rbac\Module::class,
                'file' => \intermundia\yiicms\modules\file\Module::class,
                'system' => \intermundia\yiicms\modules\system\Module::class,
            ]
        ],
    ],
    'as globalAccess' => [
        'class' => common\behaviors\GlobalAccessBehavior::class,
        'rules' => [
            [
                'controllers' => ['core/sign-in'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['login', 'unlock'],
            ],
            [
                'controllers' => ['core/sign-in'],
                'allow' => true,
                'roles' => ['@'],
                'actions' => ['logout'],
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions' => ['error'],
            ],
            [
                'controllers' => ['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'controllers' => ['user'],
                'allow' => true,
                'roles' => [\common\models\User::ROLE_ADMINISTRATOR],
            ],
            [
                'controllers' => ['user'],
                'allow' => false,
            ],
            [
                'allow' => true,
                'roles' => [
                    \common\models\User::ROLE_EDITOR,
                    \common\models\User::ROLE_MANAGER,
                    \common\models\User::ROLE_ADMINISTRATOR
                ],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'generators' => [
            'crud' => [
                'class' => yii\gii\generators\crud\Generator::class,
                'templates' => [
                    'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates'),
                ],
                'template' => 'yii2-starter-kit',
                'messageCategory' => 'backend',
            ],
        ],
    ];
}

return $config;
