<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends \frontend\components\Controller
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
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel(['product_id'=>$id,'published'=>1,'deleted'=>0,'approved'=>1]),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
		$modelCate = new \common\models\ProductCategory();
		$categories = $modelCate->getList($model->product_type);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'categories' => $categories
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$modelCate = new \common\models\ProductCategory();
		$categories = $modelCate->getList($model->product_type);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'categories' => $categories
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionGetCategories(){
		 
		$productType = Yii::$app->request->post('product_type');
		$model = new \common\models\ProductCategory();
		$categories = $model->getList($productType);
		$result = \yii\helpers\Html::dropDownList('Product[product_cate]', null, \yii\helpers\ArrayHelper::map(
			$categories,
			'category_id',
			'title'
		), ['prompt'=>'Select...','id'=>'product-product_cate','class'=>'form-control']);
		echo $result;
		\Yii::$app->end();
	}
	
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
							'id' => $model->product_id
					));
					break;
				case 'toggle-deleted':
					$model->deleted = $model->deleted == 0 ? 1 : 0;
					$model->update(false,array('deleted'));
					echo json_encode(array(
							'result' => $model->deleted,
							'id' => $model->product_id
					));
					break;
				case 'toggle-approved':
					$model->approved = $model->approved == 0 ? 1 : 0;
					$model->update(false,array('approved'));
					echo json_encode(array(
							'result' => $model->approved,
							'id' => $model->product_id
					));
					break;
				default:
					break;
			}
		}
	}
}
