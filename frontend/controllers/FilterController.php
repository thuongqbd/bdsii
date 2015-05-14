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
	
	public function actionStreet($slug,$street_id,$district_id,$province_id)
    {
        die('aaaaaaa');
    }
}
