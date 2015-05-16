<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use \yii\helpers\Url;
use \common\components\MasterValues;
use \common\components\Utils;
$modelDistrict = \common\models\District::find()->where(['province_id'=>$model->city,'id'=>$model->district])->one();
$modelCate = \common\models\ProductCategory::find()->where(['category_id'=>$model->product_cate])->andWhere('published = 1')->andWhere('deleted = 0')->one();
$modelProvince = \common\models\Province::find()->where(['id'=>$model->city])->one();
?>
<li class="clearfix pt20 pb20 bor-bot">
	<a class="pic border-gray3 w-160 h-130 fl position" href="<?= Url::to(['product/view','slug'=>$model->slug,'id'=>$model->product_id])?>">
		<?php 
		$thumb = frontend\models\ProductAttachment::findOne(['product_id'=>$model->product_id]);
		if ($thumb && \common\components\Utils::checkExistImage($thumb->path, $thumb->base_url)): ?>
			<?php echo Html::img(
				Yii::$app->glide->createSignedUrl([
					'glide/index',
					'path' => $thumb->path,
					'w' => 200
				], true)
			) ?>
		<?php endif; ?>
		<span class="bg_prices">
			<label>
				<?php
				if($model->price && $model->price_type){
					echo $model->price .' '.MasterValues::itemByValue($model->product_type==1?'price_type_sale':'price_type_rent', $model->price_type);
				}else{
					echo MasterValues::itemByValue('price_type_sale', 1);
				}
				?>
			</label>
		</span>
	</a>
	<div class="infor-descrip w-470 fr">
		<h4 class="font13 mb5">
			<?= Html::a($model->title, ['product/view', 'slug'=>$model->slug,'id'=>$model->product_id]) ?>
		</h4>
		<label class="clearfix mb5">
			<span class="time mr20 gray"> <?php echo Yii::$app->formatter->asDatetime($model->created_at) ?></span>
		</label>
		<div class="clearfix bor-top">
			<div class="w-60-100 fl tj mt10 pr10 description overflow">
				<?= Html::encode(Utils::sub_string($model->description, 40)) ?>
			</div>
			<div class="w-40-100 fl bor-left bor-right">
				<label class="bor-bot clearfix">
					<s class="ic-area fl mr5 ml5 mt8"></s>
					<span class="pd5 bor-left w-80-100 fl">
						<?php
						if(!$model->area){
							echo \common\components\MasterValues::itemByValue('search_area', 1);
						}else{
							echo $model->area.'&nbsp;m²';
						}
						?>
					</span>
				</label>
				<label class="bor-bot clearfix">
					<s class="ic-option fl mr5 ml5 mt8"></s>
					<span class="pd5 bor-left w-80-100 fl">						
						<?php 						
						$url = Url::to(['filter/district','cate'=> $modelCate->slug,'slug'=>$modelDistrict->alias,'id'=>$modelDistrict->id]);
						?>
						<?= Html::a($modelCate->title, $url) ?>
					</span>
				</label>
				<label class="bor-bot clearfix">
					<s class="ic-adress fl mr5 ml5 mt8"></s>
					<span class="pd5 bor-left w-80-100 fl"><?= Html::encode($modelDistrict->name) ?> - <?= Html::encode($modelProvince->name) ?></span>
				</label>
			</div>
		</div>
	</div>
</li>
				

