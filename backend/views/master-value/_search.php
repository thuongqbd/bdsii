<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterValueSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="master-value-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'master_value_id') ?>

    <?= $form->field($model, 'locale') ?>

    <?= $form->field($model, 'value_code') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'label') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('master_value', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('master_value', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
