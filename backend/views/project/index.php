<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('project', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('project', 'Create {modelClass}', [
    'modelClass' => 'Project',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'slug',
            'address',
            'phone',
            // 'website',
            // 'email:email',
            // 'detail:ntext',
            // 'province_id',
            // 'district_id',
            // 'ward_id',
            // 'street',
            // 'lng',
            // 'lat',
            // 'project_owner',
			[
                'attribute'=>'published',
				'format' => 'raw',
				'filter' => [Yii::t('backend', 'Not Published'),Yii::t('backend', 'Published')], 
                'value'=>function ($data) {
					return Html::a($data->published?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'id'=>'toggle-published-'.$data->id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['project/ajax-update'])."','toggle-published',".$data->id.",event)",
						]
					);
				}
            ],
			[
                'attribute'=>'deleted',
				'format' => 'raw',
				'filter' => [Yii::t('backend', 'Not Deleted'),Yii::t('backend', 'Deleted')], 
                'value'=>function ($data) {
					return Html::a($data->deleted?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'id'=>'toggle-deleted-'.$data->id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['project/ajax-update'])."','toggle-deleted',".$data->id.",event)",
						]
					);
				}
            ],
//             'deleted',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	<?php \yii\widgets\Pjax::end(); ?>
</div>
