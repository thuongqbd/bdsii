<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('product', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php 

		$productType = common\components\MasterValues::listItemByCode('product_type');
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
			'title',
			[
				'attribute'=>'product_type',
				'filter' => common\components\MasterValues::listItemByCode('product_type'),
				'filterType'=>  \kartik\grid\GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>Yii::t('product', 'Select a product type')],
				'format'=>'raw',
				'value'=>  function ($data) {
					return common\components\MasterValues::itemByValue('product_type', $data->product_type);
				},
			],
			[
				'attribute'=>'product_cate',
				'value'=>  function ($data) {
					return common\components\MasterValues::itemByValue('product_type', $data->product_type);
				},
			],
//             'city',
//             'district',
//             'ward',
//             'street',
             'project_id',
//             'area',
//             'price',
//             'price_type',
             'address',
//             'facade',
//             'entry_width',
//             'direction',
//             'balcony_direction',
//             'floor_number',
//             'room_number',
//             'toilet_number',
//             'interior:ntext',
//             'ct_name',
//             'ct_address',
//             'ct_phone',
//             'ct_mobile',
//             'ct_email:email',
//             'author_id', 
			[
				'attribute'=>'start_date',
				'filter' =>false,
//				'filterType'=>  \kartik\grid\GridView::FILTER_DATETIME_TRNTV,
//				'class' => 'kartik\grid\EditableColumn',
				'format' => ['datetime', 'dd.MM.yyyy, HH:mm'],
//				'editableOptions' => [
//					'inputType' => 'widget',
//					'widgetClass' => 'trntv\yii\datetimepicker\DatetimepickerWidget',
//				],
			],
			[
				'attribute'=>'end_date',
				'filter' =>false,
//				'class' => 'kartik\grid\EditableColumn',
				'format' => ['datetime', 'dd.MM.yyyy, HH:mm'],
//				'editableOptions' => [
//					'inputType' => 'widget',
//					'widgetClass' => 'trntv\yii\datetimepicker\DatetimepickerWidget',
//				],
			],
			[
                'attribute'=>'published',
				'format' => 'raw',
				'filter' => [Yii::t('backend', 'Not Published'),Yii::t('backend', 'Published')], 
                'value'=>function ($data) {
					return Html::a($data->published?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'id'=>'toggle-published-'.$data->product_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product/ajax-update'])."','toggle-published',".$data->product_id.",event)",
						]
					);
				}
            ],
			[
                'attribute'=>'approved',
				'format' => 'raw',
				'filter' => [Yii::t('backend', 'Not Approved'),Yii::t('backend', 'Approved')], 
                'value'=>function ($data) {
					return Html::a($data->approved?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'id'=>'toggle-approved-'.$data->product_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product/ajax-update'])."','toggle-approved',".$data->product_id.",event)",
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
							'id'=>'toggle-deleted-'.$data->product_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product/ajax-update'])."','toggle-deleted',".$data->product_id.",event)",
						]
					);
				}
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
			'containerOptions' => ['class' => 'product-pjax-container'],
			'panel'=>[
				'type'=>1,
				'heading'=>'<i class="glyphicon glyphicon-book"></i>  Product',
			],
			'toolbar'=>[
				[
					'content'=>
						Html::button('<i class="glyphicon glyphicon-plus"></i>', [
							'type'=>'button', 
							'title'=>Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Product',]), 
							'class'=>'btn btn-success',
							'onclick'=>'window.location.replace("'.yii\helpers\Url::toRoute('product/create').'")'
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
//		echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'product_id',
//            'title',
//            'slug',
//            'description:ntext',
//            'product_type',
//			[
//                'attribute'=>'published',
//				'format' => 'raw',
//				'filter' => [Yii::t('product', 'Unpublished'),Yii::t('product', 'Published')], 
//                'value'=>function ($data) {
//					return Html::a($data->published?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
//						'#', 
//						[
//							'id'=>'toggle-published-'.$data->product_id,
//							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product/ajax-update'])."','toggle-published',".$data->product_id.",event)",
//						]
//					);
//				}
//            ],
//			[
//                'attribute'=>'approved',
//				'format' => 'raw',
//				'filter' => [Yii::t('product', 'Unapproved'),Yii::t('product', 'Approved')], 
//                'value'=>function ($data) {
//					return Html::a($data->approved?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
//						'#', 
//						[
//							'id'=>'toggle-approved-'.$data->product_id,
//							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product/ajax-update'])."','toggle-approved',".$data->product_id.",event)",
//						]
//					);
//				}
//            ],
//			[
//                'attribute'=>'deleted',
//				'format' => 'raw',
//				'filter' => [Yii::t('product', 'Undeleted'),Yii::t('product', 'Deleted')], 
//                'value'=>function ($data) {
//					return Html::a($data->deleted?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
//						'#', 
//						[
//							'id'=>'toggle-deleted-'.$data->product_id,
//							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product/ajax-update'])."','toggle-deleted',".$data->product_id.",event)",
//						]
//					);
//				}
//            ],
//            // 'product_cate',
//            // 'city',
//            // 'district',
//            // 'ward',
//            // 'street',
//            // 'project_id',
//            // 'area',
//            // 'price',
//            // 'price_type',
//            // 'address',
//            // 'facade',
//            // 'entry_width',
//            // 'direction',
//            // 'balcony_direction',
//            // 'floor_number',
//            // 'room_number',
//            // 'toilet_number',
//            // 'interior:ntext',
//            // 'ct_name',
//            // 'ct_address',
//            // 'ct_phone',
//            // 'ct_mobile',
//            // 'ct_email:email',
//            // 'approved',
//            // 'author_id',
//            // 'start_date',
//            // 'end_date',
//            // 'created_at',
//            // 'updated_at',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); 
	?>

</div>
