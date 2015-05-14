<?php
namespace common\components\widgets;

use Yii;
use \common\components\MasterValues;
use \common\components\Utils;

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
		$model = new \frontend\models\Product();
		$modelCate = \common\models\ProductCategory::findAll(['published'=>1,'deleted'=>0],['order'=>'order_num']);
		$listCate = [];
		foreach ($modelCate as $cate) {
			$tmp = ["id" => $cate->category_id,"text"=>$cate->title];
			if($cate->product_type == MasterValues::MV_PT_FOR_SALE)
				$jsonCate[1][] = $tmp;
			elseif($cate->product_type == MasterValues::MV_PT_FOR_RENT)
				$jsonCate[2][] = $tmp;
			
			if($cate->product_type == MasterValues::MV_PT_FOR_SALE)
				$listCate['sale'][$cate->category_id] = $cate->title;
			elseif($cate->product_type == MasterValues::MV_PT_FOR_RENT)
				$listCate['rent'][$cate->category_id] = $cate->title;
		}
//		var_dump($listCate);die;
		$model->setScenario('frontendSearch');
        return $this->render('SearchBox',['model'=>$model,'listCate'=>$listCate,'jsonCate'=>$jsonCate]);
    }
}


