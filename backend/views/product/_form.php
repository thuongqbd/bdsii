<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//var_dump(Yii::$app->language);die;
/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

	<div class="box box-success">
		<div class="box-header"><h3 class="box-title"><?= Yii::t('product', 'Key information')?></h3></div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-6">

							<?= $form->field($model, 'product_type')->widget(\kartik\select2\Select2::classname(), [
								'data' => common\components\MasterValues::listItemByCode('product_type'),
								'options' => ['placeholder' => Yii::t('product', 'Type')],
								'pluginOptions' => [
									'allowClear' => true
								],
								'pluginEvents' => [
		//							"select2-selecting"=>"function() {console.log('select2-selecting',this.value);}",
								]
							]);?>
						</div>
						<div class="col-sm-6">

							<?php
							$selectedCate= common\models\ProductCategory::getSelectedCate($model->product_cate);
							echo Html::hiddenInput('product_cate_hidden', $model->product_cate, ['id'=>'product_cate_hidden']);
							echo $form->field($model, 'product_cate')->widget(kartik\depdrop\DepDrop::classname(), [
								'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
								'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
								'data'=>  $selectedCate?$selectedCate:[],
								'pluginOptions'=>[
									'depends'=>['product-product_type'],
									'initialize'=>true,
									'placeholder'=>Yii::t('product', 'Category'),
									'url'=>  \yii\helpers\Url::to(['/product/get-cate-list']),
									'params'=>['product_cate_hidden']
								]
							]);
							?>
						</div>
					</div>
						<div class="row">
							<div class="col-sm-6">
								<?= $form->field($model, 'city')->widget(\kartik\select2\Select2::classname(), [
									'data' => common\models\Province::getProvinceList(),
									'options' => ['placeholder' =>  Yii::t('product', 'City/Province')],
									'pluginEvents' => [
										"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
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
										'depends'=>['product-city'],
										'placeholder'=> Yii::t('product', 'District'),
										'url'=>  \yii\helpers\Url::to(['/product/get-district']),
										'params'=>['district_hidden']
									],
									'pluginEvents' => [
										"select2:select"=>"function() {console.log('select2-selecting district',this.value);Utils.changeAddress('product',this);}",
										"select2:unselect" => "function() {console.log('select2-removed_dis'); Utils.changeAddress('product',this,2); }",
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
										'depends'=>['product-city','product-district'],
										'initialize'=>!$model->isNewRecord?true:false,
										'placeholder'=> Yii::t('product', 'Ward/Commune'),
										'url'=>  \yii\helpers\Url::to(['/product/get-ward']),
										'params'=>['ward_hidden']
									],
									'pluginEvents' => [
										"select2:select"=>"function() {console.log('select2-selecting city',this.value); Utils.changeAddress('product',this); }",
										"select2:unselect" => "function() {console.log('select2-removed-ward'); Utils.changeAddress('product',this,2); }",
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
										'depends'=>['product-city','product-district'],
										'initialize'=>!$model->isNewRecord?true:false,
										'placeholder'=> Yii::t('product', 'Street'),
										'url'=>  \yii\helpers\Url::to(['/product/get-street']),
										'params'=>['street_hidden']
									],
									'pluginEvents' => [
										"select2:select"=>"function() {console.log('select2-selecting street',this.value); Utils.changeAddress('product',this); }",
										"select2:unselect" => "function() {console.log('select2-removed-str'); Utils.changeAddress('product',this,2); }",
			//							"depdrop.afterChange"=>"function(event, id, value) { Utils.changeAddress('product');}",
									]
								]);
								?>
							</div>
							
						</div>
						<div class="row">
							<div class="col-sm-12">
								<?php
								$project = $model->getProjectForProduct();
								if($project){
									echo Html::hiddenInput('Project[lat]', $project->lat,['id'=>'project-lat']);
									echo Html::hiddenInput('Project[lng]', $project->lng,['id'=>'project-lng']);
								}
								$selectedProject = !$model->isNewRecord?common\models\Project::getSelectedProject($model->project_id):false;
								echo Html::hiddenInput('project_id_hidden', $model->project_id, ['id'=>'project_id_hidden']);
								echo $form->field($model, 'project_id')->widget(kartik\depdrop\DepDrop::classname(), [
									'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
									'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
									'data'=>  $selectedProject?$selectedProject:[],
									'pluginOptions'=>[
										'depends'=>['product-city','product-district'],
										'initialize'=>!$model->isNewRecord?true:false,
										'placeholder'=> Yii::t('product', 'Project'),
										'url'=>  \yii\helpers\Url::to(['/product/get-project']),
										'params'=>['project_id_hidden']
									],
									'pluginEvents' => [
										"select2:select"=>"function() {console.log('select2-selecting project_id',this.value); Utils.changeAddress('product',this); }",
										"select2:unselect" => "function() {console.log('select2-pro'); Utils.changeAddress('product',this,2); }",
			//							"depdrop.afterChange"=>"function(event, id, value) { Utils.changeAddress('product');}",
									]
								]);
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								 <?php echo $form->field($model, 'area')->textInput() ?>
							</div>
							<div class="col-sm-4">
								  <?php echo $form->field($model, 'price')->textInput() ?>
							</div>
							<div class="col-sm-4">
								 <?php // echo $form->field($model, 'price_type')->textInput() ?>
								<?php
								$selectedPriceType= common\components\MasterValues::itemByValue($model->product_type == 1?'price_type_sale':'price_type_rent', $model->price_type,true);
								echo Html::hiddenInput('price_type_hidden', $model->price_type, ['id'=>'price_type_hidden']);
								echo $form->field($model, 'price_type')->widget(kartik\depdrop\DepDrop::classname(), [
									'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
									'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
									'data'=>  $selectedPriceType?$selectedPriceType:[],
									'pluginOptions'=>[
										'depends'=>['product-product_type'],
										'initialize'=>true,
										'placeholder'=> Yii::t('product', 'Price Type'),
										'url'=>  \yii\helpers\Url::to(['/product/get-price-type-list']),
										'params'=>['price_type_hidden']
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
				</div>
				<div class="col-sm-5">
					<?php echo Html::hiddenInput('Product[lat]', $model->lat,['id'=>'product-lat']) ?>
					<?php echo Html::hiddenInput('Product[lng]', $model->lng,['id'=>'product-lng']) ?>					
					<?php echo thuongqbd\googlemap\GoogleMapWidget::widget(
						['lat'=>$model->lat,'lng'=>$model->lng,'height'=>'430px','resultContainers'=>["lat"=>"product-lat","lng"=>"product-lng","address"=>""]]
					)?>
				</div>
			</div>			
		</div>
	</div>
	
	<div class="box box-success">
		<div class="box-header"><h3 class="box-title"><?= Yii::t('product', 'Property description')?></h3></div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					 <?php echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
				</div>				
			</div>
			<div class="row">
				<div class="col-sm-12">
					 <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<?= $form->field($model, 'start_date')->widget('trntv\yii\datetimepicker\DatetimepickerWidget',['phpDatetimeFormat'=>'dd.MM.yyyy']) ?>
				</div>
				<div class="col-sm-4">
					<?= $form->field($model, 'end_date')->widget('trntv\yii\datetimepicker\DatetimepickerWidget',['phpDatetimeFormat'=>'dd.MM.yyyy']) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?= $form->field($model, 'attachments')->widget(
						\trntv\filekit\widget\Upload::className(),
						[
							'url' => ['/file-storage/upload'],
							'sortable'=>true,
							'maxFileSize' => 10000000, // 10 MiB
							'maxNumberOfFiles' => 10,
							'subDir' => 'product'
						]);
					?>		
				</div>
				
			</div>
			
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-sm-8">
			<div class="box box-success">
				<div class="box-header"><h3 class="box-title"><?= Yii::t('product', 'Additional information')?></h3></div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-6">
							 <?php echo $form->field($model, 'facade')->textInput() ?>
						</div>
						<div class="col-sm-6">
							 <?php echo $form->field($model, 'entry_width')->textInput() ?>
						</div>				
					</div>
					<div class="row">
						<div class="col-sm-6">
							<?= $form->field($model, 'direction')->widget(\kartik\select2\Select2::classname(), [
								'data' => common\components\MasterValues::listItemByCode('direction'),
								'options' => ['placeholder' => Yii::t('product', 'Direction')],
								'pluginOptions' => [
									'allowClear' => true
								],
							]);?>
						</div>
						<div class="col-sm-6">
							<?= $form->field($model, 'balcony_direction')->widget(\kartik\select2\Select2::classname(), [
								'data' => common\components\MasterValues::listItemByCode('direction'),
								'options' => ['placeholder' => Yii::t('product', 'Balcony Direction')],
								'pluginOptions' => [
									'allowClear' => true
								],
							]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<?php echo $form->field($model, 'floor_number')->textInput() ?>				
						</div>
						<div class="col-sm-4">
							<?php echo $form->field($model, 'room_number')->textInput() ?>
						</div>
						<div class="col-sm-4">
							<?php echo $form->field($model, 'toilet_number')->textInput() ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<?php echo $form->field($model, 'interior')->textarea(['rows' => 6]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="box box-success">
				<div class="box-header"><h3 class="box-title"><?= Yii::t('product', 'Contact information')?></h3></div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12">
							 <?php echo $form->field($model, 'ct_name')->textInput(['maxlength' => 50]) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							  <?php echo $form->field($model, 'ct_address')->textInput(['maxlength' => 255]) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							   <?php echo $form->field($model, 'ct_phone')->textInput() ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							  <?php echo $form->field($model, 'ct_mobile')->textInput() ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							   <?php echo $form->field($model, 'ct_email')->textInput(['maxlength' => 255]) ?>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
