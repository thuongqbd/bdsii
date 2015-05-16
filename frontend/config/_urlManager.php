<?php
return [
    'class'=>'common\components\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
	'suffix' => '.html',
    'rules'=> [
        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Articles
        ['pattern'=>'article/index', 'route'=>'article/index'],
        ['pattern'=>'article/<slug>', 'route'=>'article/view'],
		
//		['pattern'=>'<slug:\w+>-pd<id>', 'route'=>'filter/view'],
//		['pattern'=>'<slug:\w+>-pc<product_cate>', 'route'=>'filter/cate'],
		
		//for type
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>', 'route'=>'filter/type'],
		
			
		
		//for ward
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<prefix:(phuong|xa|thi-tran|ward)>-<slug:[\w-]+>-w<id:[0-9]+>', 'route'=>'filter/ward'],
		['pattern'=>'<cate:[\w-]+>-<prefix:(phuong|ward)>-<slug:[\w-]+>-w<id:[0-9]+>', 'route'=>'filter/ward'],
		
		//for street
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<prefix:(duong|pho|street)>-<slug:[\w-]+>-s<id:[0-9]+>', 'route'=>'filter/street'],
		['pattern'=>'<cate:[\w-]+>-<prefix:(duong|pho|street)>-<slug:[\w-]+>-s<id:[0-9]+>', 'route'=>'filter/street'],
		
		//for province
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<slug:[\w-]+>-p<id:[0-9]+>', 'route'=>'filter/province'],
		['pattern'=>'<cate:[\w-]+>-<slug:[\w-]+>-p<id:[0-9]+>', 'route'=>'filter/province'],
		
		//for district
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<slug:[\w-]+>-d<id:[0-9]+>', 'route'=>'filter/district'],
		['pattern'=>'<cate:[\w-]+>-<slug:[\w-]+>-d<id:[0-9]+>', 'route'=>'filter/district'],
		
		//for project
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<slug:[\w-]+>-pj<id:[0-9]+>', 'route'=>'filter/project'],
		['pattern'=>'<cate:[\w-]+>-<slug:[\w-]+>-pj<id:[0-9]+>', 'route'=>'filter/project'],
		
		//for categoty
		['pattern'=>'<cate:[\w-]+>', 'route'=>'filter/category'],
		
		
        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],
		
    ]
];
