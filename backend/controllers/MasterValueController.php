<?php

namespace backend\controllers;

use Yii;
use common\models\MasterValue;
use common\models\MasterValueSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterValueController implements the CRUD actions for MasterValue model.
 */
class MasterValueController extends \common\components\Controller
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
     * Lists all MasterValue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasterValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		// validate if there is a editable input saved via AJAX
		if (Yii::$app->request->post('hasEditable')) {
			// instantiate your book model for saving
			$id = Yii::$app->request->post('editableKey');
			$model = MasterValue::findOne($id);

			// store a default json response as desired by editable
			$out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);

			// fetch the first entry in posted data (there should 
			// only be one entry anyway in this array for an 
			// editable submission)
			// - $posted is the posted data for Book without any indexes
			// - $post is the converted array for single model validation
			$post = [];
			$posted = current($_POST['MasterValue']);
			$post['MasterValue'] = $posted;

			// load model like any single model validation
			if ($model->load($post)) {
				// can save model or do something before saving model
				$model->save();

				// custom output to return to be displayed as the editable grid cell
				// data. Normally this is empty - whereby whatever value is edited by 
				// in the input by user is updated automatically.
				$output = '';

				// specific use case where you need to validate a specific
				// editable column posted when you have more than one 
				// EditableColumn in the grid view. We evaluate here a 
				// check to see if buy_amount was posted for the Book model
//				if (isset($posted['label'])) {
//				   $output =  $posted['label'];
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
     * Displays a single MasterValue model.
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
     * Creates a new MasterValue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterValue();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->master_value_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MasterValue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->master_value_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MasterValue model.
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
     * Finds the MasterValue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterValue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterValue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
