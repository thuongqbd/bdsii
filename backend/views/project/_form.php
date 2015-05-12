<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="col-sm-7">
			<div class="row">
				<div class="col-sm-12">
					<?php echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo $form->field($model, 'title_en')->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<?= $form->field($model, 'city')->widget(\kartik\select2\Select2::classname(), [
						'data' => common\models\Province::getProvinceList(),
						'options' => ['placeholder' => Yii::t('product', 'Select City/Province')],
						'pluginEvents' => [
							"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('project',this);}",
						]
					]);?>
				</div>
				<div class="col-sm-6">
					<?php
					$selectedDistrict = common\models\District::getSelectedDistrict($model->district);
					echo Html::hiddenInput('district_hidden', $model->district, ['id'=>'district_hidden']);
					echo $form->field($model, 'district')->widget(kartik\depdrop\DepDrop::classname(), [
						'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
						'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
						'data'=>  $selectedDistrict?$selectedDistrict:[],
						'pluginOptions'=>[
							'depends'=>['project-city'],
							'placeholder'=>Yii::t('product', 'Select District'),
							'url'=>  \yii\helpers\Url::to(['/project/get-district']),
							'params'=>['district_hidden']
						],
						'pluginEvents' => [
							"sselect2:select"=>"function() {console.log('select2-selecting district',this.value);Utils.changeAddress('project',this);}",
							"select2:unselect" => "function() {console.log('select2-removed_dis'); Utils.changeAddress('project',this,2); }",
						]
					]);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<?php
					$selectedWard = !$model->isNewRecord?common\models\Ward::getSelectedWard($model->ward):false;
					echo Html::hiddenInput('ward_hidden', $model->ward, ['id'=>'ward_hidden']);
					echo $form->field($model, 'ward')->widget(kartik\depdrop\DepDrop::classname(), [
						'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
						'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
						'data'=>  $selectedWard?$selectedWard:[],
						'pluginOptions'=>[
							'depends'=>['project-city','project-district'],
							'initialize'=>!$model->isNewRecord?true:false,
							'placeholder'=>Yii::t('product', 'Select Ward'),
							'url'=>  \yii\helpers\Url::to(['/project/get-ward']),
							'params'=>['ward_hidden']
						],
						'pluginEvents' => [
							"select2:select"=>"function() {console.log('select2-selecting city',this.value); Utils.changeAddress('project',this); }",
							"select2:unselect" => "function() {console.log('select2-removed-ward'); Utils.changeAddress('project',this,2); }",
						]
					]);
					?>
				</div>
				<div class="col-sm-6">
					<?php
					$selectedStreet = !$model->isNewRecord?common\models\Street::getSelectedStreet($model->street):false;
					echo Html::hiddenInput('street_hidden', $model->street, ['id'=>'street_hidden']);
					echo $form->field($model, 'street')->widget(kartik\depdrop\DepDrop::classname(), [
						'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
						'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
						'data'=>  $selectedStreet?$selectedStreet:[],
						'pluginOptions'=>[
							'depends'=>['project-city','project-district'],
							'initialize'=>!$model->isNewRecord?true:false,
							'placeholder'=>Yii::t('product', 'Select Street'),
							'url'=>  \yii\helpers\Url::to(['/project/get-street']),
							'params'=>['street_hidden']
						],
						'pluginEvents' => [
							"select2:select"=>"function() {console.log('select2-selecting street',this.value); Utils.changeAddress('project',this); }",
							"select2:unselect" => "function() {console.log('select2-removed-str'); Utils.changeAddress('project',this,2); }",
						]
					]);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php echo $form->field($model, 'address_en')->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<?php echo Html::hiddenInput('Project[lat]', $model->lat,['id'=>'project-lat']) ?>
			<?php echo Html::hiddenInput('Project[lng]', $model->lng,['id'=>'project-lng']) ?>					
			<?php echo thuongqbd\googlemap\GoogleMapWidget::widget(
				['lat'=>$model->lat,'lng'=>$model->lng,'height'=>'430px','resultContainers'=>["lat"=>"project-lat","lng"=>"project-lng","address"=>""]]
			)?>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-4">
			<?php echo $form->field($model, 'phone')->textInput() ?>
		</div>
		<div class="col-sm-4">
			<?php echo $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>
		</div>
		<div class="col-sm-4">
			<?php echo $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-6">
			<?php echo $form->field($model, 'project_owner')->textInput() ?>
		</div>
		<div class="col-sm-6">
			<?php echo $form->field($model, 'published')->checkbox() ?>				
			<?php echo $form->field($model, 'deleted')->checkbox() ?>
		</div>
	</div>
	<?= $form->field($model, 'detail')->widget(
        \yii\imperavi\Widget::className(),
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video'],
            'options' => [
                'minHeight' => 400,
                'maxHeight' => 400,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => false,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
            ]
        ]
    ) ?>
	<?= $form->field($model, 'detail_en')->widget(
        \yii\imperavi\Widget::className(),
        [
            'plugins' => ['fullscreen', 'fontcolor', 'video'],
            'options' => [
                'minHeight' => 400,
                'maxHeight' => 400,
                'buttonSource' => true,
                'convertDivs' => false,
                'removeEmptyTags' => false,
                'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
            ]
        ]
    ) ?>
    <?php // echo $form->field($model, 'lng')->textInput(['maxlength' => 20]) ?>

    <?php // echo $form->field($model, 'lat')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
