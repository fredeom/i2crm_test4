<?php

if (!defined('DATABASE_URL')) {
  define('DATABASE_URL', 'postgres://sms:Rjvgjn123@localhost/sms');
}

$db = parse_url(DATABASE_URL);
echo "<pre>";
var_dump($db);

$db["path"] = ltrim($db["path"], "/");

var_dump($db);
echo "</pre>";
exit(0);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    //require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    //require __DIR__ . '/../config/main-local.php'
  );

// echo "<h1>from frontend/web before Application run</h1>";
// exit(0);

(new yii\web\Application($config))->run();
