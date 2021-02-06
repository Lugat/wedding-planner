<?php

  switch ($_SERVER['SERVER_NAME']) {

    case 'localhost':

      defined('YII_DEBUG') or define('YII_DEBUG', true);
      defined('YII_ENV') or define('YII_ENV', 'dev');

      error_reporting(E_ALL);
      ini_set('display_errors', 1);

    break;
    default:

      defined('YII_DEBUG') or define('YII_DEBUG', false);
      defined('YII_ENV') or define('YII_ENV', 'prod');

      ini_set('display_errors', 0);

    break;

  }

  require __DIR__.'/../vendor/autoload.php';
  require __DIR__.'/../vendor/yiisoft/yii2/Yii.php';

  $config = require __DIR__.'/../config/web.php';

  (new yii\web\Application($config))->run();