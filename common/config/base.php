<?php
$config = [
    'name'=>'Yii2 Starter Kit',
    'vendorPath'=>dirname(dirname(__DIR__)).'/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
	'timeZone' => 'Asia/Ho_Chi_Minh',
    'sourceLanguage'=>'vi',
    'language'=>'vi',
    'bootstrap' => ['log'],
    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],

        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
//		'fileCache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'formatter'=>[
            'class'=>'yii\i18n\Formatter'
        ],

        'glide' => [
            'class' => 'trntv\glide\components\Glide',
            'sourcePath' => '@storage/web/source',
            'cachePath' => '@storage/cache',
            'urlManager' => 'urlManagerStorage',
//            'maxImageSize' => getenv('GLIDE_MAX_IMAGE_SIZE'),
//            'signKey' => getenv('GLIDE_SIGN_KEY'),
			'maxImageSize' => 4000000,
            'signKey' => 'pRATWiUHbjjB_ZWUFxWQuQs1hi1z_ImS'
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => YII_ENV_DEV,
            'messageConfig' => [
                'charset' => 'UTF-8',
//                'from' => getenv('ADMIN_EMAIL'),
				'from' => 'thuongqbd@gmail.com'
            ]
        ],

        'db'=>[
            'class'=>'yii\db\Connection',
//            'dsn' => getenv('DB_DSN'),
//            'username' => getenv('DB_USERNAME'),
//            'password' => getenv('DB_PASSWORD'),
//            'tablePrefix' => getenv('DB_TABLE_PREFIX'),
			'dsn' => 'mysql:host=localhost;port=3306;dbname=bdsii',
            'username' => 'root',
            'password' => '',
            'tablePrefix' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
                    'prefix'=>function () {
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

        'i18n' => [
//			'class' => 'common\components\I18N',
            'translations' => [
                'app'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
					'forceTranslation' => true
                ],
                /* '*'=> [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                    'fileMap'=>[
                        'common'=>'common.php',
                        'backend'=>'backend.php',
                        'frontend'=>'frontend.php',
                    ]
                ],*/
                // Uncomment this code to use DbMessageSource
                 '*'=> [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%i18n_source_message}}',
                    'messageTable'=>'{{%i18n_message}}',
                    'enableCaching' => YII_ENV_DEV,
                    'cachingDuration' => 3600,
					'forceTranslation' => true,
//					'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
                ],               
            ],
//			'as missingTranslation' =>function(){
//
//			}    
        ],

        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@storageUrl/source',
			'useSubDir' => true,
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@storage/web/source'
            ],
            'as log' => [
                'class' => 'common\components\behaviors\FileStorageLogBehavior',
                'component' => 'fileStorage'
            ]
        ],

        'keyStorage' => [
            'class' => 'common\components\keyStorage\KeyStorage'
        ],
		'urlManager' => [
			'class'=>'common\components\UrlManager',
			'languages' => ['vi','en'],
			'enablePrettyUrl'=>true,
			'showScriptName'=>false,
			'enableLanguagePersistence' => false,
		],
        'urlManagerBackend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo' => Yii::getAlias('@backendUrl')
            ],
            require(Yii::getAlias('@backend/config/_urlManager.php'))
        ),
        'urlManagerFrontend' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo'=>Yii::getAlias('@frontendUrl')
            ],
            require(Yii::getAlias('@frontend/config/_urlManager.php'))
        ),
        'urlManagerStorage' => \yii\helpers\ArrayHelper::merge(
            [
                'hostInfo'=>Yii::getAlias('@storageUrl')
            ],
            require(Yii::getAlias('@storage/config/_urlManager.php'))
        )
    ],
    'params' =>  require('params.php'),
//	'on beforeAction' => function ($event) {
//
//    },
];

if (YII_ENV_PROD) {
    $config['components']['cache'] = [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@common/runtime/cache'
    ];

    $config['components']['log']['targets']['email'] = [
        'class' => 'yii\log\EmailTarget',
        'except' => ['yii\web\HttpException:*'],
        'levels' => ['error', 'warning'],
//        'message' => ['from' => getenv('ROBOT_EMAIL'), 'to' => getenv('ADMIN_EMAIL')]
		'message' => ['from' => 'thuongqbd@gmail.com', 'to' =>'thuongqbd@gmail.com']
    ];
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module'
    ];
}

return $config;