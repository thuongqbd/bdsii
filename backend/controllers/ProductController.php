<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends \common\components\Controller
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
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		// validate if there is a editable input saved via AJAX
		if (Yii::$app->request->post('hasEditable')) {
			// instantiate your book model for saving
			$id = Yii::$app->request->post('editableKey');
			$model = Product::findOne($id);

			// store a default json response as desired by editable
			$out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);

			// fetch the first entry in posted data (there should 
			// only be one entry anyway in this array for an 
			// editable submission)
			// - $posted is the posted data for Book without any indexes
			// - $post is the converted array for single model validation
			$post = [];
			$posted = current($_POST['Product']);
			$post['Product'] = $posted;
			$k = [];
			foreach ($post['Product'] as $key => $value) {
				if($value && in_array($key, ['start_date','end_date'])){
					$post['Product'][$key] = strtotime($value);
					$k[] = $key;
				}
				
			}
			
			// load model like any single model validation
			if ($model->load($post)) {
//				var_dump($k,$model->attributes);die;
				// can save model or do something before saving model
				$model->update(false,$k);

				// custom output to return to be displayed as the editable grid cell
				// data. Normally this is empty - whereby whatever value is edited by 
				// in the input by user is updated automatically.
				$output = '';

				// specific use case where you need to validate a specific
				// editable column posted when you have more than one 
				// EditableColumn in the grid view. We evaluate here a 
				// check to see if buy_amount was posted for the Book model
//				if (isset($post['Product']['start_date'])) {
//				   $output = strtotime($post['Product']['start_date']);
//				} 

				// similarly you can check if the name attribute was posted as well
				// if (isset($posted['name'])) {
				//   $output =  ''; // process as you need
				// } 
				$out = \yii\helpers\Json::encode(['output'=>$output, 'message'=>'']);
			} 
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
