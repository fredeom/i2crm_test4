<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

\Yii::setAlias('theme_view', '@frontend/themes/advert/views');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'defaultRoute' => '/main',
    'modules' => [
      'main' => [
        'class' => 'app\modules\main\Module'
      ],
      'cabinet' => [
        'class' => 'app\modules\cabinet\Module',
      ],
    ],
    'components' => [
        'view' => [
          'theme' => [
            'class' => 'frontend\themes\advert\Theme',
            'basePath' => '@app/',
            'baseUrl'  => '@web/',
          ],
        ],
        'common' => [
          'class' => 'frontend\components\Common'
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'VERY SECRET COOKIE FROM main-local.php',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/main/main/login',
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
          'errorAction' => 'site/error'
        ],
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //     ],
        // ],
    ],
    'params' => $params,
];
