<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategory */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
	<?php echo $form->field($model, 'title_en')->textInput(['maxlength' => 255]) ?>
    <?php //echo $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

	<div class="row">
        <div class="col-sm-6">
			<?php //echo $form->field($model, 'product_type')->dropDownList(common\components\MasterValues::listItemByCode('product_type'),['prompt'=>'Select...']) ?>
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
//				$selectedCate= common\models\ProductCategory::getSelectedCate($model->parent_id);
//				echo Html::hiddenInput('product_cate_parent_id', $model->parent_id, ['id'=>'product_cate_hidden']);
//				echo $form->field($model, 'parent_id')->widget(kartik\depdrop\DepDrop::classname(), [
//					'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
//					'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
//					'data'=>  $selectedCate?$selectedCate:[],
//					'pluginOptions'=>[
//						'depends'=>['product-category-product_type'],
//						'initialize'=>true,
//						'placeholder'=>Yii::t('product_category','Parent'),
//						'url'=>  \yii\helpers\Url::to(['/product/get-parents-list']),
//						'params'=>['product_cate_hidden']
//					]
//				]);
				?>
		</div>
	</div>
    <?php echo $form->field($model, 'keyword')->textInput(['maxlength' => 255]) ?>
	<?php echo $form->field($model, 'keyword_en')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->field($model, 'description')->textarea() ?>
	<?php echo $form->field($model, 'description_en')->textarea() ?>
    

    
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-6">
				<?= $form->field($model, 'thumbnail')->widget(
					\trntv\filekit\widget\Upload::className(),
					[
						'url' => ['/file-storage/upload'],
						'maxFileSize' => 5000000, // 5 MiB
						'subDir' => 'productcategory'
					]);
				?>
			</div>
			<div class="col-sm-6">				
				<?php echo $form->field($model, 'order_num')->textInput() ?>				
				<?php echo $form->field($model, 'published')->checkbox() ?>				
				<?php echo $form->field($model, 'deleted')->checkbox() ?>				
			</div>
		</div>
        
	</div>
    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
		<?php echo Html::hiddenInput('ProductCategory[category_id]',$model->category_id,['id'=>'productcategory-category_id']) ?>
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
