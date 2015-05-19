<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
/* @var $form yii\bootstrap\ActiveForm */

?>
<script>
	var listCate = JSON.parse('<?php echo $jsonCate?>');
	var listPriceType = JSON.parse('<?php echo $jsonPriceType?>');
</script>
<div class="box search mt40 mb30">
	<?php 
	$form = ActiveForm::begin(); 
	$form->action = Yii::getAlias('@frontend');
	?>
	<?php echo Html::hiddenInput('Product[product_type]', $model->product_type, ['id'=>'product_type_hidden']);?>
	<div class="title-tabs bor-bot-blue4 font-roboto position">
		<ul class="type_bds clearfix">
			<li class="font15 uppercase fl"><a rel="nofollow" data-value="1" class="product-type-tab <?php echo $selectedTab==2?'':$selectedTab==1?'active':''?>">BĐS bán</a></li>
			<li class="font15 uppercase fl"><a rel="nofollow" data-value="2" class="product-type-tab <?php echo $selectedTab==2?'active':''?>" >BĐS cho thuê</a></li>
		</ul>
	</div>
	<div class="box-cont bor-left bor-right bor-bot box-shadow pd10">
		<ul>			
			<li class="item">
				<?php
				echo Html::hiddenInput('product_cate', $model->product_cate, ['id'=>'product_cate_hidden']);
				echo $form->field($model, 'product_cate')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => $selectedTab==2?$listCate["rent"]:$listCate["sale"],
					'options' => ['placeholder' =>  Yii::t('product', 'Category')],
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
					'options' => ['placeholder' =>  Yii::t('product', 'City/Province')],
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
						'data'=> isset($dataSelected['data']['district'])?$dataSelected['data']['district']:[],
//						'data'=> [53=>'Quận 1'],
//						'options' => ['placeholder' =>  Yii::t('product', 'Select District')],
						'pluginOptions'=>[
							'depends'=>['product-city'],
							'placeholder' =>  Yii::t('product', 'District'),
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
					'data' => common\components\MasterValues::listItemByCode('search_area'),
					'options' => ['placeholder' =>  Yii::t('product', 'Area')],
					'pluginOptions'=>['allowClear'=>true],
					'theme'=>'krajee',
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
			</li>
			<li class="item">
				<?= $form->field($model, 'price')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => $selectedTab==2?$listPriceType['rent']:$listPriceType['sale'],
					'options' => ['placeholder' =>  Yii::t('product', 'Price')],
					'pluginOptions'=>['allowClear'=>true],
					'theme'=>'krajee',
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
			</li>
			<li class="item" style="min-width:0;width:128px;margin-right:0">
				<button id="btnSearch" type="submit" class="bt-search bg-orange nobor cursor white bold uppercase font15 font-roboto fl" rel="nofollow" > 
				<s class="ic-search fl mt2 mr5"></s>
				<span class="mt2 fl">Tìm kiếm</span>
				</button>
				<a class="bt-search-adv bg-orange nobor cursor white bold uppercase font15 font-roboto fl" id="adv-search" title="<?= Yii::t('product','Advance Search ')?>">
					<s class="ic-tools fl mt2 mr5"></s>
				</a>
			</li>
			<li id="advanced" class="width-full mt10 fl <?= $isAdvanceSearch?'':'hidden'?>">
				<ul class="mt5">
					<li class="item">
						<?php
							echo Html::hiddenInput('ward_hidden', $model->ward, ['id'=>'ward_hidden']);
							echo $form->field($model, 'ward')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
								'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
								'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
//								'options' => ['placeholder'=> Yii::t('product', 'Select Ward'),],
								'data'=> isset($dataSelected['data']['ward'])?$dataSelected['data']['ward']:[],
								'pluginOptions'=>[
									'depends'=>['product-city','product-district'],
									'initialize'=>true,
									'placeholder' =>  Yii::t('product', 'Ward/Commune'),
									'url'=>  \yii\helpers\Url::to(['/site/get-ward']),
									'params'=>['ward_hidden']
								],
							]);
							?>
					</li>
					<li class="item">
						<?php
						echo Html::hiddenInput('street_hidden', $model->street, ['id'=>'street_hidden']);
						echo $form->field($model, 'street')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
							'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
							'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
//							'data'=> isset($dataSelected['street'])?$dataSelected['street']:[],
							'pluginOptions'=>[
								'depends'=>['product-city','product-district'],
//								'initialize'=>true,
								'placeholder'=> Yii::t('product', 'Street'),
								'url'=>  \yii\helpers\Url::to(['/site/get-street']),
								'params'=>['street_hidden']
							],
						]);
						?>
					</li>
					<li class="item">
						<?php
						echo Html::hiddenInput('project_id_hidden', $model->project_id, ['id'=>'project_id_hidden']);
						echo $form->field($model, 'project_id')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
							'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
							'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
//							'data'=> isset($dataSelected['project'])?$dataSelected['project']:[],
							'pluginOptions'=>[
								'depends'=>['product-city','product-district'],
//								'initialize'=>true,
								'placeholder'=> Yii::t('product', 'Project'),
								'url'=>  \yii\helpers\Url::to(['/site/get-project']),
								'params'=>['project_id_hidden']
							],
						]);
						?>
					</li>
					<li class="item">
						<?= $form->field($model, 'room_number')->label(false)->widget(\kartik\select2\Select2::classname(), [
							'data' => common\components\MasterValues::listItemByCode('search_room_number'),
							'options' => ['placeholder' =>  Yii::t('product', 'Room Number')],
							'pluginOptions'=>['allowClear'=>true],
							'theme'=>'krajee',
		//					'pluginEvents' => [
		//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
		//					]
						]);?>
					</li>
					<li class="item">
						<?= $form->field($model, 'direction')->label(false)->widget(\kartik\select2\Select2::classname(), [
							'data' => common\components\MasterValues::listItemByCode('direction'),
							'options' => ['placeholder' =>  Yii::t('product', 'Direction')],
							'pluginOptions'=>['allowClear'=>true],
							'theme'=>'krajee',
		//					'pluginEvents' => [
		//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
		//					]
						]);?>
					</li>					
				</ul>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	
	<?php ActiveForm::end(); ?>
</div>