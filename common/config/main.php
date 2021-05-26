<?php
return [
    'name' => 'My first yii2 project',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'mail' => [
          'class' => 'zyx\phpmailer\Mailer',
          'viewPath' => '@common/mail',
          'useFileTransport' => false,
          'config' => [
            'mailer' => 'smtp',
            'host' => 'smtp.yandex.ru',
            'port' => '465',
            'smtpsecure' => 'ssl',
            'smtpauth' => true,
            'username' => 'fredeom@ya.ru',
            'password' => '',
            'ishtml' => true,
            'charset' => 'utf-8',
          ],
        ],
        'cache' => [
          'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
          'class' => 'yii\web\UrlManager',
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
            'pages/<view:[a-zA-Z0-9-]+>' => 'main/main/page',
            'view-advert/<id:\d+>' => 'main/main/view-advert',
            'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>'
          ],
        ]
    ],
];
