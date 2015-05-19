<?php

namespace backend\controllers;

use Yii;
use common\models\ProductCategory;
use common\models\ProductCategorySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends \backend\components\Controller
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
     * Lists all ProductCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model = new ProductCategory();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'categories' => $model->getList(),
        ]);
    }

    /**
     * Displays a single ProductCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCategory();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->category_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'categories' => $model->getList($model->product_type),
            ]);
        }
    }

    /**
     * Updates an existing ProductCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id,true);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->category_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'categories' => $model->getList($model->product_type,$model->category_id),
            ]);
        }
    }

    /**
     * Deletes an existing ProductCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id,$ml=false)
    {
		if($ml){
			$model = ProductCategory::find()->multilingual()->where(['category_id'=>$id])->one();
		}else{
			$model = ProductCategory::findOne($id);
		}
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
//	public function actionGetParentsList(){
//		 
//		$productType = Yii::$app->request->post('product_type');
//		$model = new ProductCategory();
//		$categories = $model->getList($productType,(int) Yii::$app->request->post('category_id'));
//		$result = \yii\helpers\Html::dropDownList('ProductCategory[parent_id]', null, \yii\helpers\ArrayHelper::map(
//			$categories,
//			'category_id',
//			'title'
//		), ['prompt'=>'Select...','id'=>'productcategory-parent_id','class'=>'form-control']);
//		echo $result;
//	}
	
	/*
	 * ajaxUpdate
	* */
	public function actionAjaxUpdate() {
		if (isset($_POST['ajax'])) {
			$model = $this->findModel((int) $_POST['id']);
			$action = $_POST['action'];
			switch ($action) {
				case 'toggle-published':
					$model->published = $model->published == 0 ? 1 : 0;
					$model->update(false,array('published'));
					echo json_encode(array(
							'result' => $model->published,
							'id' => $model->category_id
					));
					break;
				case 'toggle-deleted':
					$model->deleted = $model->deleted == 0 ? 1 : 0;
					$model->update(false,array('deleted'));
					echo json_encode(array(
							'result' => $model->deleted,
							'id' => $model->category_id
					));
					break;
				default:
					break;
			}
		}
	}
}
