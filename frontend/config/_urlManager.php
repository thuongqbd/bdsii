<?php
return [
    'class'=>'common\components\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
	'suffix' => '.html',
    'rules'=> [
		
		['pattern'=>'', 'route'=>'site/index'],
        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Articles
        ['pattern'=>'article/index', 'route'=>'article/index'],
        ['pattern'=>'article/<slug>', 'route'=>'article/view'],
		
		//product
		['pattern'=>'<slug>-pr0<id:[0-9]+>', 'route'=>'product/view'],
	
		//full
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|huyen|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho|province|city)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|huyen|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho|province|city)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter','suffix' => '.html'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		
		//without street
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		
		//without ward
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		
		//without project
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		
		//without street and ward
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>-prj-<project:[\w-]+>', 'route'=>'filter/filter'],
		
		//without street and project
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<wPrefix:(phuong|xa|thi-tran|ward)>-<ward:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		
		//without ward and project
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<sPrefix:(duong|pho|street)>-<street:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		
		//without street and ward and project
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<dPrefix:(quan|district)>-<district:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		
		
		//without district (street and ward and and project)
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>-<pPrefix:(tinh|thanh-pho)>-<province:[\w-]+>', 'route'=>'filter/filter'],
		
		//without street and ward and district and province
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<type:(nha-dat-ban|nha-dat-cho-thue|for-sale|for-rent)>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>/<area:[0-9]+>/<price:[0-9]+>/<room_number:[0-9]+>/<direction:[0-9]+>', 'route'=>'filter/filter'],
		['pattern'=>'<cate:[\w-]+>', 'route'=>'filter/filter'],
		
        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],
		
    ]
];
