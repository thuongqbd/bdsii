<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('product_category', 'Product Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Product Category',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'category_id',
            'title',
			'title_en',
//            'slug',
			[
				'attribute'=>'parent_id',
				'filter' =>\yii\helpers\ArrayHelper::map(
						$categories,
						'category_id',
						'title'
					),
				'value'=>  function ($data) {
					return $data->getParentName();
				},
			],
			[
				'attribute'=>'product_type',
				'filter' => common\components\MasterValues::listItemByCode('product_type'),
				'value'=>  function ($data) {
					return common\components\MasterValues::itemByValue('product_type', $data->product_type);
				},
			],
			[
                'attribute'=>'published',
				'format' => 'raw',
				'filter' => [Yii::t('backend', 'Not Published'),Yii::t('backend', 'Published')], 
                'value'=>function ($data) {
					return Html::a($data->published?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'title' => Yii::t('yii', 'Close'),
							'id'=>'toggle-published-'.$data->category_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product-category/ajax-update'])."','toggle-published',".$data->category_id.",event)",
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
							'title' => Yii::t('yii', 'Close'),
							'id'=>'toggle-deleted-'.$data->category_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product-category/ajax-admin'])."','toggle-deleted',".$data->category_id.",event)",
						]
					);
				}
            ],
            // 'description',
            // 'keyword',
            // 'image',
            // 'order_num',
            // 'published',
            // 'deleted',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	<?php \yii\widgets\Pjax::end(); ?>
</div>
