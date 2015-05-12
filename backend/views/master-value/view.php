<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MasterValue */

$this->title = $model->master_value_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('master_value', 'Master Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-value-view">

    <p>
        <?= Html::a(Yii::t('master_value', 'Update'), ['update', 'id' => $model->master_value_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('master_value', 'Delete'), ['delete', 'id' => $model->master_value_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('master_value', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'master_value_id',
            'locale',
            'value_code',
            'value',
            'order_num',
            'description',
            'label',
        ],
    ]) ?>

</div>
