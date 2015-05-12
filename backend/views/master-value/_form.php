<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterValue */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="master-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'locale')->dropDownList(Yii::$app->params['availableLocales']) ?>

    <?php echo $form->field($model, 'value_code')->textInput(['maxlength' => 50]) ?>

    <?php echo $form->field($model, 'value')->textInput(['maxlength' => 50]) ?>

    <?php echo $form->field($model, 'order_num')->textInput() ?>

    <?php echo $form->field($model, 'description')->textInput(['maxlength' => 500]) ?>

    <?php echo $form->field($model, 'label')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
