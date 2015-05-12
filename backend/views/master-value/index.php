<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasterValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('master_value', 'Master Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-value-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php 
		$gridColumns = [
			[
				'class'=>'kartik\grid\SerialColumn',
				'contentOptions'=>['class'=>'kartik-sheet-style'],
				'width'=>'36px',
				'header'=>'',
				'headerOptions'=>['class'=>'kartik-sheet-style']
			],
			[
				'class'=>'kartik\grid\CheckboxColumn',
				'headerOptions'=>['class'=>'kartik-sheet-style'],
			],
			'master_value_id',
			[
				'attribute'=>'locale',
				'filter' =>Yii::$app->params['availableLocales'],
				'class' => 'kartik\grid\EditableColumn',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
					'data'=>Yii::$app->params['availableLocales'],
					'displayValueConfig'=>Yii::$app->params['availableLocales'],
					'options' => [						
						'pluginOptions' => ['min'=>0, 'max'=>5000]
					]
				],
			],
			[
				'attribute'=>'value_code',
				'class' => 'kartik\grid\EditableColumn',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_TEXT,					
				],
			],
			[
				'attribute'=>'value',
				'class' => 'kartik\grid\EditableColumn',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_TEXT,					
				],
			],
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute'=>'label', 
		//        'readonly'=>function($model, $key, $index, $widget) {
		//            return (!$model->status); // do not allow editing of inactive records
		//        },
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_TEXT,
					'options' => [
						'pluginOptions' => ['min'=>0, 'max'=>5000]
					]
				],
//				'hAlign'=>'right', 
//				'vAlign'=>'middle',
//				'width'=>'100px',
		//        'format'=>['decimal', 2],
				'pageSummary' => true
			],
			'description',
			['class' => 'yii\grid\ActionColumn'],
		];
 
		// the GridView widget (you must use kartik\grid\GridView)
		echo \kartik\grid\GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => $gridColumns,
			'export' => false,
			'pjax'=>true,
			'containerOptions' => ['class' => 'master-value-pjax-container'],
			'panel'=>[
				'type'=>1,
				'heading'=>'<i class="glyphicon glyphicon-book"></i>  Master Values',
			],
			'toolbar'=>[
				[
					'content'=>
						Html::button('<i class="glyphicon glyphicon-plus"></i>', [
							'type'=>'button', 
							'title'=>Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Master Values',]), 
							'class'=>'btn btn-success',
							'onclick'=>'window.location.replace("'.yii\helpers\Url::toRoute('master-value/create').'")'
						]) . ' '.
						Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], [
							'class' => 'btn btn-default', 
							'title' => Yii::t('backend', 'Reset Grid')
						]),
				]
			]
		]);
	?>
    <?php
//	 echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'master_value_id',
//			[
//				'attribute'=>'locale',
//				'filter' =>Yii::$app->params['availableLocales'],				
//			],
//            'value_code',
//            'value',
//			'label',
//            'order_num',
//             'description',
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); 
	 ?>

</div>
