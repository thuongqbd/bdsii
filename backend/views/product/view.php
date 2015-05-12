<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->product_id], [
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
            'product_id',
            'title',
            'slug',
            'description:ntext',
            'product_type',
            'product_cate',
            'city',
            'district',
            'ward',
            'street',
            'project_id',
            'area',
            'price',
            'price_type',
            'address',
            'facade',
            'entry_width',
            'direction',
            'balcony_direction',
            'floor_number',
            'room_number',
            'toilet_number',
            'interior:ntext',
            'ct_name',
            'ct_address',
            'ct_phone',
            'ct_mobile',
            'ct_email:email',
            'approved',
            'author_id',
            'start_date',
            'end_date',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
