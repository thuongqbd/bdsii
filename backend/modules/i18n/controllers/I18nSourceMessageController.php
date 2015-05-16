<?php

namespace backend\modules\i18n\controllers;

use Yii;
use backend\modules\i18n\models\I18nSourceMessage;
use backend\modules\i18n\models\search\I18nSourceMessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * I18nSourceMessageController implements the CRUD actions for I18nSourceMessage model.
 */
class I18nSourceMessageController extends \backend\components\Controller
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
     * Lists all I18nSourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new I18nSourceMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		// validate if there is a editable input saved via AJAX
		if (Yii::$app->request->post('hasEditable')) {
			// instantiate your book model for saving
			$id = Yii::$app->request->post('editableKey');

			$model = I18nSourceMessage::findOne($id);
			$out = ['output'=>'', 'message'=>''];
			if($model){
				// store a default json response as desired by editable
				

				$post = [];
				$posted = current($_POST['I18nMessage']);
				$post['I18nMessage'] = $posted;

				if ($model->load($post)) {
					// can save model or do something before saving model
					$model->save();										
				} 				
			}else{
				$out['message'] = \Yii::t('common', 'Error');
			}			
			// return ajax json encoded response and exit
			echo \yii\helpers\Json::encode($out);
			return;
		}
		
		$categories = \yii\helpers\ArrayHelper::map(
            I18nSourceMessage::find()->select('category')->distinct()->all(),
            'category',
            'category'
        );
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'categories' => $categories
        ]);
    }

    /**
     * Displays a single I18nSourceMessage model.
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
     * Creates a new I18nSourceMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new I18nSourceMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing I18nSourceMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing I18nSourceMessage model.
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
     * Finds the I18nSourceMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return I18nSourceMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = I18nSourceMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
