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

	const MV_PRICE_TYPE_SALE = 1;
	const MV_PRICE_TYPE_SALE_CODE = 'price_type_sale';
	const MV_PRICE_TYPE_RENT = 2;
	const MV_PRICE_TYPE_RENT_CODE = 'price_type_rent';

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

		if(is_array($code)){
			$result = [];
			foreach ($model as $value) {
				if(array_search($value->value_code, $code) !== FALSE)
					$result[$value->value_code][$value->value] = $value->label;
			}
			return $result;
		}
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
	}
	
	public static function descByValue($code, $value,$forDropList = false, $locale=null){

		$model = MasterValue::findOne(
		[
			'locale' => substr(($locale!=null)?$locale:Yii::$app->language, 0,2),
			'value_code'=>$code,
			'value'=> $value
		],[
			'order'=>'`order`'
		]
		);
		
		if(isset($model->description)){
			if($forDropList)
				return [$model->value=>$model->description];
			else
				return $model->description;
		}else{
			return ;
		}
	}
	
	public static function itemByDesc($code, $desc, $locale=null){

		$model = MasterValue::findOne(
		[
			'locale' => substr(($locale!=null)?$locale:Yii::$app->language, 0,2),
			'value_code'=>$code,
			'description'=> $desc
		],[
			'order'=>'`order`'
		]
		);
		
		if(isset($model->value)){			
				return $model->value;
		}else{
			return ;
		}
	}
	
	public static function findByCondition($condition,$multi = false, $locale=null){
		$find = MasterValue::find()->where($condition)->andWhere(['locale' => substr(($locale!=null)?$locale:Yii::$app->language, 0,2)])->orderBy('order_num');
		if($multi){
			$model = $find->all();
		}else{
			$model = $find->one();
		}
		if($model){			
				return $model;
		}else{
			return [];
		}
	}
}