<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('product_category', 'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-view">

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category_id',
            'title',
            'slug',
			[
				'attribute'=>'parent_id',
				'value'=>  $model->getParentName(),
			],
			[
				'attribute'=>'product_type',
				'value'=>  common\components\MasterValues::itemByValue('product_type', $model->product_type),
			],
            'description',
            'keyword',
			[
				'attribute'=>'image',
				'format' => 'raw',
				'value'=>  Html::img($model->thumbnail_base_url.'/'.$model->thumbnail_path, ['width'=>'100','height'=>'100']),
			],
            'order_num',
			[
                'attribute'=>'published',
				'format' => 'raw',
                'value'=>Html::a($model->published?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'title' => Yii::t('yii', 'Close'),
							'id'=>'toggle-published-'.$model->category_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product-category/ajax-admin'])."','toggle-published',".$model->category_id.",event)",
						]
					)
            ],
			[
                'attribute'=>'deleted',
				'format' => 'raw',
                'value'=>Html::a($model->deleted?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>',
						'#', 
						[
							'title' => Yii::t('yii', 'Close'),
							'id'=>'toggle-deleted-'.$model->category_id,
							'onclick'=>"Utils.ajaxUpdate('".yii\helpers\Url::to(['product-category/ajax-admin'])."','toggle-deleted',".$model->category_id.",event)",
						]
					)
            ],
			[
                'attribute' => 'created_at',
                'format' => ['date', 'dd-MM-Y'],
			],
			[
                'attribute' => 'updated_at',
                'format' => ['date', 'dd-MM-Y'],
			]
        ],
    ]) ?>

</div>
