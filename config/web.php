<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fad324%41gd@3455hadzy&55',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
		'authManager' => [
                           'class' => 'yii\rbac\DbManager',
                           'defaultRoles' => ['guest'],
          ],
		  'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
		],
		
		
		
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,

           /*'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'smtp.yandex.ru',  
             'username' => 'master@adpaintball.ru',
             'password' => 'z654321z!',
             'port' => '465', 
             'encryption' => 'ssl', 
         ],*/
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
		
        'db' => require(__DIR__ . '/db.php'),



     'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages',
               //'sourceLanguage' => 'en',
                'fileMap' => [
                    'app' => 'app.php',
                    'app/error' => 'error.php',
                ],
            ],
        ],
    ],

  
    ],

    'as beforeRequest' => [
        'class' => 'app\components\changeLanguage',
     ],


    // start modules config
	'modules' => [


        'superadmin' => [
            'class' => 'app\modules\superadmin\SuperAdmin',
            'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['superadmin'],
                ],
                ],
            ],
        ],
   
        'admin' => [
            'class' => 'app\modules\admin\Admin',
			
			'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['admin'],
                ],
				],
            ],
        ],


         'supplier' => [
            'class' => 'app\modules\supplier\Supplier',

            'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['supplier'],
                ],
                ],
            ],
        ],

         'advertiser' => [
            'class' => 'app\modules\advertiser\Advertiser',

            'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['advertiser'],
                ],
                ],
            ],
        ],
		
     
   
    ], // end modules config






    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
