<?php
namespace common\components\widgets;

use Yii;
use \common\components\MasterValues;
use \common\components\Utils;
use \yii\helpers\ArrayHelper;

class SearchBox extends \yii\base\Widget
{
    /**
     * @var string text block key
     */
    public $key;

    /**
     * @return string
     */
    public function run()
    {		
//		var_dump(\Yii::$app->requestedParams);
		$model = new \frontend\models\Product();
		$model->product_type = 1;
		$modelCate = \common\models\ProductCategory::findAll(['published'=>1,'deleted'=>0],['order'=>'order_num']);
		$listCate = [];
		$jsonCate = [];
		foreach ($modelCate as $cate) {
			$tmp = ["id" => $cate->category_id,"text"=>$cate->title];
			if($cate->product_type == MasterValues::MV_PT_FOR_SALE){
				$listCate['sale'][$cate->category_id] = $cate->title;
				$jsonCate[MasterValues::MV_PT_FOR_SALE][] = $tmp;
			}else{
				$listCate['rent'][$cate->category_id] = $cate->title;
				$jsonCate[MasterValues::MV_PT_FOR_RENT][] = $tmp;
			}
		}
		
		$modelPriceType = \common\models\MasterValue::find()->where(['value_code'=>['search_price_type_sale','search_price_type_rent']])->andWhere(['locale'=>  substr(Yii::$app->language, 0,2)])->all();
		$listPriceType = [];
		$jsonPriceType = [];
		foreach ($modelPriceType as $type) {
			$tmp = ["id" => $type->value,"text"=>$type->label];
			if($type->value_code == 'search_price_type_sale'){
				$listPriceType['sale'][$type->value] = $type->label;
				$jsonPriceType[MasterValues::MV_PT_FOR_SALE][] = $tmp;
			}else{
				$listPriceType['rent'][$type->value] = $type->label;
				$jsonPriceType[MasterValues::MV_PT_FOR_RENT][] = $tmp;
			}
		}

		$model->setScenario('frontendSearch');
        return $this->render('SearchBox',[
			'model'=>$model,
			'listCate'=>$listCate,
			'jsonCate'=>  json_encode($jsonCate),
			'listPriceType'=>$listPriceType,
			'listPriceType' => $listPriceType,
			'jsonPriceType' => json_encode($jsonPriceType)
				]);
    }
}


