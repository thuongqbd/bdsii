<?php

namespace frontend\controllers;

use Yii;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use frontend\models\Product;
use common\models\ProductCategory;
use common\models\District;
use common\models\Province;
use common\models\Ward;
use common\models\Street;
use common\models\Project;
use common\components\MasterValues;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class FilterController extends \frontend\components\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionFilter($type=null,$cate=null,$province=null,$district=null,$ward=null,$street=null,$project=null,$area=null,$price=null,$room_number=null,$direction=null,$pPrefix=null,$dPrefix=null,$wPrefix=null,$sPrefix=null)
    {
		$session = [];
		$condition = ['published'=>1,'deleted'=>0,'approved'=>1];
		$message = [];
		$query =  Product::find();
		$isDefaultLang = substr(\Yii::$app->language, 0,2) == \Yii::$app->params['defaultLanguage']?true:false;
		$typeSelected = MasterValues::MV_PRICE_TYPE_SALE;
		if(!empty($cate) && $modelCate = ProductCategory::find()->where(['slug'=>$cate])->andWhere('published = 1')->andWhere('deleted = 0')->one()){
			$condition['product_cate'] = $modelCate->category_id;
			$message['type'] = $modelCate->title;
			$session['id']['product_cate'] = $modelCate->category_id;
			$session['id']['product_type'] = $modelCate->product_type;
			$typeSelected = $modelCate->product_type;
		}
		if(!empty($type)){
			$condition['product_type'] = MasterValues::itemByDesc('product_type', $type);
			$message['type'] = !empty($message['type'])?$message['type']:MasterValues::itemByValue('product_type', $condition['product_type']);
			$session['id']['product_type'] = $condition['product_type'];
			$typeSelected = $condition['product_type'];
		}
		if(!empty($province) && $modelProvince = Province::findOne(['alias'=>$province])){
			$condition['city'] = $modelProvince->id;
			$message['city'] = $modelProvince->name;
			$session['id']['city'] = $modelProvince->id;
			$titleMess = \Yii::t('product','{type} at {location}',['type'=> $message['type'],'location'=>$modelProvince->prefix .' '. $message['city']]);
			if(!empty($district) && $modelDistrict = District::findOne(['alias'=>$district,'province_id'=>$modelProvince->id])){			
				$condition['district'] = $modelDistrict->id;
				$message['district'] = $modelDistrict->name;
				$session['id']['district'] = $modelDistrict->id;
				$session['data']['district'] = [$modelDistrict->id=>$modelDistrict->name];
				$titleMess = \Yii::t('product','{type} at {location}',['type'=> $message['type'],'location'=>$modelDistrict->prefix .' '. $message['district']]);
				if(!empty($ward) && $modelWard = Ward::findOne(['alias'=>$ward,'province_id'=>$modelProvince->id,'district_id'=>$modelDistrict->id])){
					$condition['ward'] = $modelWard->id;
					$message['ward'] = $modelWard->name;
					$session['id']['ward'] = $modelWard->id;
					$session['data']['ward'] = [$modelWard->id=>$modelWard->name];
					$titleMess = \Yii::t('product','{type} at {location}',['type'=> $message['type'],'location'=>$modelWard->prefix .' '. $message['ward']]);
				}
				
				if(!empty($street) && $modelStreet = Street::findOne(['alias'=>$street,'province_id'=>$modelProvince->id,'district_id'=>$modelDistrict->id])){
					$condition['street'] = $modelStreet->id;
					$message['street'] = $modelStreet->name;
					$session['id']['street'] = $modelStreet->id;
					$session['data']['street'] = [$modelStreet->id=>$modelStreet->name];
					$titleMess = \Yii::t('product','{type} at {location}',['type'=> $message['type'],'location'=>$modelStreet->prefix .' '. $message['street']]);
				}
				
				if(!empty($project) && $modelProject = Project::findOne(['slug'=>$project,'city'=>$modelProvince->id,'district'=>$modelDistrict->id])){
					$condition['project_id'] = $modelProject->id;
					$message['project'] = $modelProject->title;
					$session['id']['project_id'] = $modelProject->id;
					$session['data']['project'] = [$modelProject->id=>$modelProject->title];
					$titleMess = \Yii::t('product','{type} at {location}',['type'=> $message['type'],'location'=>$message['project']]);
				}			
			}
		}else{
			$titleMess = \Yii::t('product','{type} at {location}',['type'=> $message['type'],'location'=>$isDefaultLang?'Việt Nam':'Viet Nam']);
		}
		
		$query->where($condition);

		if($area && $master = MasterValues::findByCondition(['value_code'=>'search_area','value'=>$area])){
			$query->andWhere($master->description);
			$session['id']['area'] = $area;
			$message['area'] = $master->label;
		}
		if($price && $master = MasterValues::findByCondition(['value_code'=>$typeSelected == MasterValues::MV_PRICE_TYPE_SALE?'search_price_type_sale':'search_price_type_rent','value'=>$price])){
			$query->andWhere($master->description);
			$session['id']['price'] = $price;
			$message['price'] = $master->label;
		}
		if($room_number && $master = MasterValues::findByCondition(['value_code'=>'search_room_number','value'=>$room_number])){
			$query->andWhere($master->description);
			$session['id']['room_number'] = $room_number;
			$message['room_number'] = $master->label;
		}
		if($direction && $master = MasterValues::findByCondition(['value_code'=>'direction','value'=>$direction])){
			$query->andWhere('direction = :direction',[':direction'=>(int) $direction]);
			$session['id']['direction'] = $direction;
			$message['direction'] = $master->label;
		}
		$order = 0;
		if(isset($_POST['order']) && $master = MasterValues::findByCondition(['value_code'=>'search_order','value'=>(int)$_POST['order']])){
			$query->orderBy($master->description);
			$order = (int)$_POST['order'];
		}		
		Yii::$app->session->set('filter', $session);
	
        $dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => Yii::$app->params['pageSize']['productFilter'],
			],
		]);

		$listModels = $dataProvider->getModels();
		$listDistrictId = [];
		$listCateId = [];
		$listProvinceId = [];
		foreach ($listModels as $model) {
			$listDistrictId[] = $model->district;
			$listCateId[] = $model->product_cate;
			$listProvinceId[] = $model->city;
		}
		
		$modelDistricts = $listDistrictId?District::find()->where(['id'=>$listDistrictId])->all():[];
		$listDistricts = [];
		foreach ($modelDistricts as $district) {
			$listDistricts[$district->id] = ['name'=>$district->name,'alias'=>$district->alias];
		}
		
		$modelCates = $listCateId?ProductCategory::find()->where(['category_id'=>$listCateId])->andWhere('published = 1')->andWhere('deleted = 0')->all():[];
		$listCates = [];
		foreach ($modelCates as $cate) {
			$listCates[$cate->category_id] = ['title'=>$cate->title,'slug'=>$cate->slug];
		}
		
		$modelProvinces = $listProvinceId?Province::find()->where(['id'=>$listProvinceId])->all():[];
		$listProvinces = [];
		foreach ($modelProvinces as $province) {
			$listProvinces[$province->id] = ['name'=>$province->name,'alias'=>$province->alias];
		}
		
		$priceType = MasterValues::listItemByCode([MasterValues::MV_PRICE_TYPE_SALE_CODE,MasterValues::MV_PRICE_TYPE_RENT_CODE]);
//		var_dump($priceType);die;
		return $this->render('filter',[
			'dataProvider'=>$dataProvider,
			'listProvinces' => $listProvinces,
			'listDistricts' => $listDistricts,
			'listCates' => $listCates,
			'priceType' => $priceType,
			'message' => $message,
			'titleMess' => $titleMess,
			'typeSelected' => $typeSelected,
			'order' => $order
			]
		);
    }
	
    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($slug,$id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
