<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'product_type') ?>

    <?php // echo $form->field($model, 'product_cate') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'ward') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_type') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'facade') ?>

    <?php // echo $form->field($model, 'entry_width') ?>

    <?php // echo $form->field($model, 'direction') ?>

    <?php // echo $form->field($model, 'balcony_direction') ?>

    <?php // echo $form->field($model, 'floor_number') ?>

    <?php // echo $form->field($model, 'room_number') ?>

    <?php // echo $form->field($model, 'toilet_number') ?>

    <?php // echo $form->field($model, 'interior') ?>

    <?php // echo $form->field($model, 'ct_name') ?>

    <?php // echo $form->field($model, 'ct_address') ?>

    <?php // echo $form->field($model, 'ct_phone') ?>

    <?php // echo $form->field($model, 'ct_mobile') ?>

    <?php // echo $form->field($model, 'ct_email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
