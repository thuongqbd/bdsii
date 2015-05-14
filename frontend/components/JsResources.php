<?php
namespace frontend\components;
use Yii;

class JsResources {
	private static $JS_MESSAGE;
	
	public static function jsMessage(){
		if(null === self::$JS_MESSAGE)
		{
			self::$JS_MESSAGE =	array(
				"product_cate" => Yii::t('product', 'Category'),
				"price" => Yii::t('product', 'Price'),
			);
		}
		return self::$JS_MESSAGE;
	}
}