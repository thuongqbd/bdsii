<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */

$this->title = Yii::t('common', 'Update {modelClass}: ', [
    'modelClass' => 'Product Category',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('product_category', 'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="product-category-update">

    <?= $this->render('_form', [
        'model' => $model,
		'categories' => $categories,
    ]) ?>

</div>
