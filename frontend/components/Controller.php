<?php

namespace frontend\components;

use Yii;
use \common\components\MasterValues;
use	\common\components\Utils;
use	\yii\helpers\Url;

class Controller extends \yii\web\Controller{
	
	public function beforeAction($action)
    {
		
        if(isset($_POST['Product'])){
			$post = $_POST['Product'];
			$firstParam = null;
			$isCate = false;
			if(!empty($post['product_cate'])){
				$cate = \common\models\ProductCategory::find()
						->where('category_id = :category_id',[':category_id'=>$post['product_cate']])
						->andWhere('published = 1')->andWhere('deleted = 0')->one();
				if($cate){
					$firstParam = $cate->slug;
					$isCate = true;
				}
			}
			if(!$firstParam){
				$firstParam = MasterValues::descByValue('product_type', $post['product_type']);
			}
			
			if(!empty($post['project_id']) && !empty($post['city']) && !empty($post['district'])){
				$model = \common\models\Project::find()->where(['id'=>$post['project_id'],'published'=>1,'deleted'=>0])->one();
				if($model){
					if($isCate){
						$url = Url::to(['filter/project','cate'=> $firstParam,'slug'=>$model->slug,'id'=>$model->id]);
					}else{						
						$url = Url::to(['filter/project','type'=> $firstParam,'slug'=>$model->slug,'id'=>$model->id]);
					}
				}
			}
			elseif(!empty($post['street']) && !empty($post['city']) && !empty($post['district'])){
				$model = \common\models\Street::find()->where(['province_id'=>$post['city'],'district_id'=>$post['district'],'id'=>$post['street']])->one();
				if($model){
					$prefix = Utils::stripUnicode($model->prefix);
					if($isCate){
						$url = Url::to(['filter/street','cate'=> $firstParam,'prefix'=>$prefix,'slug'=>$model->alias,'id'=>$model->id]);
					}else{						
						$url = Url::to(['filter/street','type'=> $firstParam,'prefix'=>$prefix,'slug'=>$model->alias,'id'=>$model->id]);
					}
				}
			}
			elseif(!empty($post['ward']) && !empty($post['city']) && !empty($post['district'])){
				$model = \common\models\Ward::find()->where(['province_id'=>$post['city'],'district_id'=>$post['district'],'id'=>$post['ward']])->one();
				if($model){				
					$prefix = Utils::stripUnicode($model->prefix);
					if($isCate){
						$url = Url::to(['filter/ward','cate'=> $firstParam,'prefix'=>$prefix,'slug'=>$model->alias,'id'=>$model->id]);
					}else{						
						$url = Url::to(['filter/ward','type'=> $firstParam,'prefix'=>$prefix,'slug'=>$model->alias,'id'=>$model->id]);
					}
				}
			}elseif(!empty($post['district']) && !empty($post['city'])){
				$model = \common\models\District::find()->where(['province_id'=>$post['city'],'id'=>$post['district']])->one();
				if($model){				
					if($isCate){
						$url = Url::to(['filter/district','cate'=> $firstParam,'slug'=>$model->alias,'id'=>$model->id]);
					}else{						
						$url = Url::to(['filter/district','type'=> $firstParam,'slug'=>$model->alias,'id'=>$model->id]);
					}
				}
			}elseif(!empty($post['city'])){
				$model = \common\models\Province::find()->where(['id'=>$post['city']])->one();
				if($model){				
					if($isCate){
						$url = Url::to(['filter/province','cate'=> $firstParam,'slug'=>$model->alias,'id'=>$model->id]);
					}else{						
						$url = Url::to(['filter/province','type'=> $firstParam,'slug'=>$model->alias,'id'=>$model->id]);
					}
				}
			}elseif($isCate){
				$url = Url::to(['filter/category','cate'=> $firstParam]);
			}else{
				$url = Url::to(['filter/type','type'=> $firstParam]);
			}

			if(!empty($url))
				$this->redirect($url,302);
		}
		return parent::beforeAction($action);
    }
		
	public function actionGetDistrict() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$provinceId = $parents[0];
				$districtId = null;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$districtId = $params[0]; // get the value of input-type-1		
				}
				$district = \common\models\District::getDistrictList($provinceId,$districtId);
				echo \yii\helpers\Json::encode($district);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionGetWard() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];			
			if ($parents != null) {
				$location['province_id'] = $parents[0];
				$location['district_id'] = $parents[1];
				$wardId = null;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$wardId = $params[0]; // get the value of input-type-1		
				}
				$ward = \common\models\Ward::getWardList($location,$wardId); 
				echo \yii\helpers\Json::encode($ward);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionGetStreet() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];			
			if ($parents != null) {
				$location['province_id'] = $parents[0];
				$location['district_id'] = $parents[1];
				$streetId = null;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$streetId = $params[0]; // get the value of input-type-1		
				}
				$street = \common\models\Street::getStreetList($location,$streetId); 
				echo \yii\helpers\Json::encode($street);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionGetProject() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];			
			if ($parents != null) {
				$location['city'] = $parents[0];
				$location['district'] = isset($parents[1])?$parents[1]:null;
				$location['ward'] = isset($parents[2])?$parents[2]:null;
				$location['street'] = isset($parents[3])?$parents[3]:null;

				$projectId = null;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$projectId = $params[0]; // get the value of input-type-1		
				}
				$project = \common\models\Project::getProjectList($location,$projectId); 
				echo \yii\helpers\Json::encode($project);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionGetCateList() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];			
			if ($parents != null) {
				$productType = $parents[0];

				$projectId = null;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$cateId = $params[0]; // get the value of input-type-1		
				}
				$project = \common\models\ProductCategory::getCateList($productType,$cateId); 
				echo \yii\helpers\Json::encode($project);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionGetPriceTypeList() {
		$out = ['output'=>[],'selected'=>''];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];			
			if ($parents != null) {
				$productType = $parents[0];

				$projectId = null;
				if (!empty($_POST['depdrop_params'])) {
					$params = $_POST['depdrop_params'];
					$priceType = $params[0]; // get the value of input-type-1		
				}
				$listPriceType = MasterValues::listItemByCode($productType == 1?'price_type_sale':'price_type_rent');
				
				if($listPriceType){
					foreach ($listPriceType as $id => $title) {
						$tmp['id'] = $id;
						$tmp['name'] = $title;
						$out['output'][] = $tmp;
					}
					if($priceType)
						$out['selected'] = $priceType;
				}				
				echo \yii\helpers\Json::encode($out);
				return;
			}
		}
		echo Json::encode($out);
	}
	
}

