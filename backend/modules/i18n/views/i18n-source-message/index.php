<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\i18n\models\search\I18nSourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'I18n Source Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-source-message-index">

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
//			'id',
			[
                'attribute'=>'category',
                'filter'=> $categories,
				'class' => 'kartik\grid\EditableColumn',
				'filterType'=>  \kartik\grid\GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>'All'],
				'format'=>'raw',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
					'data'=>$categories,
					'displayValueConfig'=>$categories,
				],
            ],
			[
                'attribute'=>'message',
				'class' => 'kartik\grid\EditableColumn',
				'editableOptions' => [
					'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
					'options'=>[						
						'style'=>'width:500px;'
					],
				],
				
            ],		
			['class' => 'yii\grid\ActionColumn'],
		];
 
		// the GridView widget (you must use kartik\grid\GridView)
		echo \kartik\grid\GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => $gridColumns,
			'export' => false,
			'pjax'=>true,
			'containerOptions' => ['class' => 'i18n-message-pjax-container'],
			'panel'=>[
				'type'=>1,
				'heading'=>'<i class="glyphicon glyphicon-book"></i> I18n Source Message',
			],
			'toolbar'=>[
				[
					'content'=>
						Html::button('<i class="glyphicon glyphicon-plus"></i>', [
							'type'=>'button', 
							'title'=>Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'I18n Message']), 
							'class'=>'btn btn-success',
							'onclick'=>'window.location.replace("'.yii\helpers\Url::toRoute('create').'")'
						]) . ' '.
						Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], [
							'class' => 'btn btn-default', 
							'title' => Yii::t('backend', 'Reset Grid')
						]),
				]
			]
		]);
	?>

</div>
