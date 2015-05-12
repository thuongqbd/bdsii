<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MasterValue */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Master Value',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('master_value', 'Master Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-value-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
