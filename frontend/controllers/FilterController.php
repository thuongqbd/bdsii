<?php

namespace frontend\controllers;

use Yii;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use \frontend\models\Product;
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
    private function filter($type=null,$cate=null,$province=null,$district=null,$ward=null,$street=null,$project=null,$page = 1)
    {
		$condition = [];
		if(!empty($type)){
			$condition['product_type'] = \common\components\MasterValues::itemByDesc('product_type', $type);
		}
		if(!empty($cate))
			$condition['product_cate'] = $cate;
		if(!empty($province))
			$condition['city'] = $province;
		if(!empty($district))
			$condition['district'] = $district;
		if(!empty($ward))
			$condition['ward'] = $ward;
		if(!empty($street))
			$condition['street'] = $street;
		if(!empty($project))
			$condition['project_id'] = $project;
//		var_dump($condition);	
        $dataProvider = new ActiveDataProvider([
			'query' => Product::find()->where($condition),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		return $this->render('filter',[
			'dataProvider'=>$dataProvider,
			'type'=>$type,
			'cate'=>$cate,
			'province'=>$province,
			'district'=>$district,
			'ward'=>$ward,
			'street'=>$street,
			'project'=>$project
			]
		);
    }
	
	public function actionType($type,$page = 1)
    {
		return $this->filter($type, null,null,null,null,null,null,$page);;
    }
	
	public function actionCategory($cate,$page = 1)
    {
		return $this->filter(null, $cate,null,null,null,null,null,$page);
    }
	
	public function actionProvince($type=null,$cate=null,$slug,$id,$page = 1)
    {
		return $this->filter($type, $cate,$id,null,null,null,null,$page);
    }
	
	public function actionDistrict($type=null,$cate=null,$slug,$id,$page = 1)
    {
		return $this->filter($type, $cate,null,$id,null,null,null,$page);
    }
	
	public function actionWard($type=null,$cate=null,$prefix="phuong",$slug,$id,$page = 1)
    {
		return $this->filter($type, $cate,null,null,$id,null,null,$page);
    }
	
	public function actionStreet($type=null,$cate=null,$prefix="phuong",$slug,$id,$page = 1)
    {
		return $this->filter($type, $cate,null,null,null,$id,null,$page);
    }
	
	public function actionProject($type=null,$cate=null,$slug,$id,$page = 1)
    {
		return $this->filter($type, $cate,null,null,null,null,$id,$page);
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
