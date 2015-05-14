<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>
<script>
	var listCate = JSON.parse('<?php echo json_encode($jsonCate)?>');
</script>
<div class="box search mt40 mb30">
	<?php $form = ActiveForm::begin(); ?>
	<?php echo Html::hiddenInput('Product[product_type]', $model->product_type, ['id'=>'product_type_hidden']);?>
	<div class="title-tabs bor-bot-blue4 font-roboto position">
		<ul class="type_bds clearfix">
			<li class="font15 uppercase fl"><a rel="nofollow" data-value="1" class="product-type-tab active">BĐS bán</a></li>
			<li class="font15 uppercase fl"><a rel="nofollow" data-value="2" class="product-type-tab" >BĐS cho thuê</a></li>
		</ul>
		<img src="images/buiding-shadow.png" alt="dothidiaoc.com" class="buiding-shadow">
	</div>
	<div class="box-cont bor-left bor-right bor-bot box-shadow pd10">
		<ul>			
			<li class="item">
				<?php
				echo Html::hiddenInput('Product[product_cate]', $model->product_cate, ['id'=>'product_cate_hidden']);
				echo $form->field($model, 'product_cate')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => $listCate["sale"],
					'options' => ['placeholder' =>  Yii::t('product', 'Select a product cate')],
					'theme'=>'krajee',
					'pluginOptions'=>['allowClear'=>true]
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
			</li>
			<li class="item">
				<?= $form->field($model, 'city')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => common\models\Province::getProvinceList(),
					'options' => ['placeholder' =>  Yii::t('product', 'Select City/Province')],
					'theme'=>'krajee',
					'pluginOptions'=>['allowClear'=>true]
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
			</li>
			<li class="item">
				<?php
					$selectedDistrict = common\models\District::getSelectedDistrict($model->district);
					echo Html::hiddenInput('district_hidden', $model->district, ['id'=>'district_hidden']);
					echo $form->field($model, 'district')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
						'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
						'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
						'data'=>  $selectedDistrict?$selectedDistrict:[],
//						'options' => ['placeholder' =>  Yii::t('product', 'Select District')],
						'pluginOptions'=>[
							'depends'=>['product-city'],
							'placeholder' =>  Yii::t('product', 'Select District'),
							'url'=>  \yii\helpers\Url::to(['/site/get-district']),
							'params'=>['district_hidden']
						],
//						'pluginEvents' => [
//							"select2:select"=>"function() {console.log('select2-selecting district',this.value);Utils.changeAddress('product',this);}",
//							"select2:unselect" => "function() {console.log('select2-removed_dis'); Utils.changeAddress('product',this,2); }",
//						]
					]);
				?>
			</li>
			<li class="item">
				<?= $form->field($model, 'area')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => [],
					'options' => ['placeholder' =>  Yii::t('product', 'Area')],
					'theme'=>'krajee',
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
			</li>
			<li class="item">
				<?= $form->field($model, 'price')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => [],
					'options' => ['placeholder' =>  Yii::t('product', 'Price')],
					'theme'=>'krajee',
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
			</li>
			<li class="item last clearfix" style="min-width: 0; padding-left: 7px !important">
				<div class="fr mt5 hidden">
					<label id="lbAdvanced" onclick="advancedSearch();" class="blue cursor underline adv-btsearch">Tìm kiếm nâng cao</label>
				</div>
			</li>
			<li id="advanced" class="width-full mt10 fl">
				<ul class="mt5">
					<li class="item">
						<?php
							$selectedWard = !$model->isNewRecord?common\models\Ward::getSelectedWard($model->ward):false;
							echo Html::hiddenInput('ward_hidden', $model->ward, ['id'=>'ward_hidden']);
							echo $form->field($model, 'ward')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
								'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
								'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
								'options' => ['placeholder'=> Yii::t('product', 'Select Ward'),],
								'data'=>  $selectedWard?$selectedWard:[],
								'pluginOptions'=>[
									'depends'=>['product-city','product-district'],
									'initialize'=>!$model->isNewRecord?true:false,							
									'url'=>  \yii\helpers\Url::to(['/site/get-ward']),
									'params'=>['ward_hidden']
								],
		//						'pluginEvents' => [
		//							"select2:select"=>"function() {console.log('select2-selecting city',this.value); Utils.changeAddress('product',this); }",
		//							"select2:unselect" => "function() {console.log('select2-removed-ward'); Utils.changeAddress('product',this,2); }",
		//						]
							]);
							?>
					</li>
					<li class="item">
						<?php
						$selectedStreet = !$model->isNewRecord?common\models\Street::getSelectedStreet($model->street):false;
						echo Html::hiddenInput('street_hidden', $model->street, ['id'=>'street_hidden']);
						echo $form->field($model, 'street')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
							'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
							'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
							'data'=>  $selectedStreet?$selectedStreet:[],
							'pluginOptions'=>[
								'depends'=>['product-city','product-district'],
								'initialize'=>!$model->isNewRecord?true:false,
								'placeholder'=> Yii::t('product', 'Select Street'),
								'url'=>  \yii\helpers\Url::to(['/site/get-street']),
								'params'=>['street_hidden']
							],
		//					'pluginEvents' => [
		//						"select2:select"=>"function() {console.log('select2-selecting street',this.value); Utils.changeAddress('product',this); }",
		//						"select2:unselect" => "function() {console.log('select2-removed-str'); Utils.changeAddress('product',this,2); }",
		////							"depdrop.afterChange"=>"function(event, id, value) { Utils.changeAddress('product');}",
		//					]
						]);
						?>
					</li>
					<li class="item">
						<?php
						$selectedProject = !$model->isNewRecord?common\models\Project::getSelectedProject($model->project_id):false;
						echo Html::hiddenInput('project_id_hidden', $model->project_id, ['id'=>'project_id_hidden']);
						echo $form->field($model, 'project_id')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
							'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
							'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
							'data'=>  $selectedProject?$selectedProject:[],
							'pluginOptions'=>[
								'depends'=>['product-city','product-district'],
								'initialize'=>!$model->isNewRecord?true:false,
								'placeholder'=> Yii::t('product', 'Select Project'),
								'url'=>  \yii\helpers\Url::to(['/site/get-project']),
								'params'=>['project_id_hidden']
							],
							'pluginEvents' => [
								"select2:select"=>"function() {console.log('select2-selecting project_id',this.value); Utils.changeAddress('product',this); }",
								"select2:unselect" => "function() {console.log('select2-pro'); Utils.changeAddress('product',this,2); }",
		//							"depdrop.afterChange"=>"function(event, id, value) { Utils.changeAddress('product');}",
							]
						]);
						?>
					</li>
					<li class="item">
						<?= $form->field($model, 'room_number')->label(false)->widget(\kartik\select2\Select2::classname(), [
							'data' => [],
							'options' => ['placeholder' =>  Yii::t('product', 'Room Number')],
							'theme'=>'krajee',
		//					'pluginEvents' => [
		//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
		//					]
						]);?>
					</li>
					<li class="item">
						<?= $form->field($model, 'direction')->label(false)->widget(\kartik\select2\Select2::classname(), [
							'data' => [],
							'options' => ['placeholder' =>  Yii::t('product', 'Direction')],
							'theme'=>'krajee',
		//					'pluginEvents' => [
		//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
		//					]
						]);?>
					</li>
					<li class="item" style="min-width:0;width:128px;margin-right:0">
						<a id="btnSearch" class="bt-seaerch bg-orange nobor cursor white bold uppercase font15 font-roboto width-full" rel="nofollow" href="javascript:__doPostBack('ctl00$PH_Container$BoxSearch$btnSearch','')"> 
						<s class="ic-search fl mt2 mr5"></s>
						<span class="mt2 fl">Tìm kiếm</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	
	<?php ActiveForm::end(); ?>
</div>