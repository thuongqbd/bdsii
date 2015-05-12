<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MasterValue */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Master Value',
]) . ' ' . $model->master_value_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('master_value', 'Master Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->master_value_id, 'url' => ['view', 'id' => $model->master_value_id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="master-value-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
