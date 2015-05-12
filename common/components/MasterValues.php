<?php
namespace common\components;

use Yii;
use common\models\MasterValue;
use yii\helpers\ArrayHelper;

class MasterValues
{
	/* Master Value code constants	 */
	const MV_LOCALE 	= 'locale';
	const MV_PT_FOR_SALE 	= 1;
	const MV_PT_FOR_RENT 	= 2;
	/* Master data for list */
	/**
	 * Returns the data model based on value_code and locale
	 * @param value_code
	 * @param locale: en, vi
	 */
//	public static function htlmListItemByCode($code, $locale=null)
//	{
//		$model = MasterValue::findAll(
//		[
//			'locale' => ($locale!=null)?$locale:Yii::$app->language,
//			'value_code'=>$code
//		],[
//			'order'=>'`order`'
//		]
//		);
//		
//		$list=ArrayHelper::map($model,'value','label');
//
//		//print_r($list);
//		
//		return CHtml::dropDownList($code, '', $list, array('empty' => '(Select a Value)'));
//	
//	}
	
	/**
	 * Returns the data model based on value_code and locale
	 * @param value_code
	 * @param locale: en, ja, vi
	 */
	public static function listItemByCode($code, $locale=null)
	{		
		$model = MasterValue::findAll(
		[
			'locale' => substr(($locale!=null)?$locale:Yii::$app->language, 0,2),
			'value_code'=>$code
		],[
			'order'=>'`order`'
		]
		);
//		var_dump($list=ArrayHelper::map($model,'value','label'));
		return ArrayHelper::map($model,'value','label');	
	}
	
	public static function itemByValue($code, $value,$forDropList = false, $locale=null){

		$model = MasterValue::findOne(
		[
			'locale' => substr(($locale!=null)?$locale:Yii::$app->language, 0,2),
			'value_code'=>$code,
			'value'=> $value
		],[
			'order'=>'`order`'
		]
		);
		
		if(isset($model->label)){
			if($forDropList)
				return [$model->value=>$model->label];
			else
				return $model->label;
		}else{
			return ;
		}
		//return $model->label;

	}
}