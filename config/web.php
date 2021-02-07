<?php

  $params = require __DIR__.'/params.php';

  $config = [
    'id' => 'Hochzeitsplaner',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
      '@bower' => '@vendor/bower-asset',
      '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
      'my' => [
        'class' => 'app\modules\my\Module',
        'defaultRoute' => 'event',
      ],
    ],
    'language' => 'de-DE',
    'sourceLanguage' => 'de-DE',
    'components' => [
      'request' => [
        'cookieValidationKey' => '-Iec3QerrOcDlLBa3ywDMTyTCka4-vLw',
      ],
      'cache' => [
        'class' => 'yii\caching\FileCache',
      ],
      'user' => [
        'identityClass' => 'app\models\Event',
        'enableAutoLogin' => true,
      ],
      'assetManager' => [
        'appendTimestamp' => YII_DEBUG,
        'linkAssets' => !YII_DEBUG,
        'bundles' => [
          'yii\web\JqueryAsset' => [
            'js' => [
              'jquery.min.js'
            ]
          ],
          'yii\bootstrap\BootstrapAsset' => [
            'css' => [],
          ],
          'yii\bootstrap4\BootstrapAsset' => [
            'css' => [],
          ],
          'yii\bootstrap4\BootstrapPluginAsset' => [
            'js' => [
              'js/bootstrap.bundle.min.js'
            ]
          ],
        ]
      ],
      'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ]
      ],
      'i18n' => [
        'translations' => [
          'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'fileMap' => [
              'app' => 'app.php',
              'app/options' => 'options.php',
            ]
          ]
        ],
      ],
      'errorHandler' => [
        'errorAction' => 'site/error',
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
      'db' => require __DIR__.'/'.YII_ENV.'/db.php',
    ],
    'params' => $params,
  ];

  if (YII_ENV_DEV) {
    
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
      'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
      'class' => 'yii\gii\Module',
    ];
    
  }

  return $config;