<?php

namespace frontend\components;

use Yii;

class Controller extends \yii\web\Controller{
	
	public function beforeAction($action)
    {
        if(isset($_POST['Product'])){
			$post = $_POST['Product'];
			if(isset($post['project_id'])){
				$url = "";
			}elseif(isset ($post['street'])){
				$url = "";
			}elseif(isset ($post['ward'])){
				
			}elseif(isset ($post['district'])){
				
			}elseif(isset ($post['city'])){
				
			}else{
				
			}
//			$url = \yii\helpers\Url::to(['filter/street','slug'=>'hellocopa','street_id'=>1,'district_id'=>2,'province_id'=>3]);
//			$this->redirect($url,302);
			var_dump($_POST);die;
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
				$listPriceType = MasterValues::listItemByCode($productType == 1?'product_type_sale':'product_type_rent');
				
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
