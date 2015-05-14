<?php

namespace backend\controllers;

use Yii;
use common\models\Project;
use common\models\ProjectSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends \backend\components\Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id,true);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	protected function findModel($id,$ml=false)
    {
		if($ml){
			$model = Project::find()->multilingual()->where(['id'=>$id])->one();
		}else{
			$model = Project::findOne($id);
		}
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
							'id' => $model->id
					));
					break;
				case 'toggle-deleted':
					$model->deleted = $model->deleted == 0 ? 1 : 0;
					$model->update(false,array('deleted'));
					echo json_encode(array(
							'result' => $model->deleted,
							'id' => $model->id
					));
					break;
				default:
					break;
			}
		}
	}
}
