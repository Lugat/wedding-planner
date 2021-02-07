<?php

  $config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
      '@bower' => '@vendor/bower-asset',
      '@npm'   => '@vendor/npm-asset',
      '@tests' => '@app/tests',
    ],
    'components' => [
      'cache' => [
        'class' => 'yii\caching\FileCache',
      ],
      'log' => [
        'targets' => [
          [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
          ],
        ],
      ],
      'db' => require __DIR__.'/'.YII_ENV.'/db.php',
    ],
    'params' => require __DIR__.'/params.php',
  ];

  if (YII_ENV_DEV) {
    
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
      'class' => 'yii\gii\Module',
    ];
    
  }

  return $config;