<?php
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
<div class="productlist">
	<div class="box news">
		<div class="font-roboto" style="border-top: 1px solid #dff2f6">
			<div class="bg_white clearfix bor-bot " style="border-top: 1px solid #0098bb">
				<div class="fl">
					<h1 class="font15 lblcate">
						<?= $titleMess?>
					</h1>
				</div>
				<div class="fr wr_order">
					<div class="lblorder"><?= Yii::t('product','Order by')?>:</div>
					<?= yii\helpers\Html::dropDownList('order', $order, common\components\MasterValues::listItemByCode('search_order'),['id'=>'filter-order','style'=>'margin-top: 2px;'])?>					
				</div>
			</div>
		</div>
		<h3 class="box-result">
			<?php
				echo Yii::t('frontend','Search by options: {type} {city} {district} {ward} {street} {project} {area} {price} {direction} {room_number} {count}',[
						'type' => '<span class="label">'.$message['type'].'.</span>',
						'city' => !empty($message['city'])?Yii::t('product', 'City/Province').': <span class="label">'.$message['city'].'.</span>':'',
						'district' => !empty($message['district'])?Yii::t('product', 'District').': <span class="label">'.$message['district'].'.</span>':'',
						'ward' => !empty($message['ward'])?Yii::t('product', 'Ward/Commune').': <span class="label">'.$message['ward'].'.</span>':'',
						'street' => !empty($message['street'])?Yii::t('product', 'Street').': <span class="label">'.$message['street'].'.</span>':'',
						'project' => !empty($message['project'])?Yii::t('product', 'Project').': <span class="label">'.$message['project'].'.</span>':'',
						'area' => !empty($message['area'])?Yii::t('product', 'Area').': <span class="label">'.$message['area'].'.</span>':'',
						'price' => !empty($message['price'])?Yii::t('product', 'Price').': <span class="label">'.$message['price'].'.</span>':'',
						'direction' => !empty($message['direction'])?Yii::t('product', 'Direction').': <span class="label">'.$message['direction'].'.</span>':'',
						'room_number' => !empty($message['room_number'])?Yii::t('product', 'Room Number').': <span class="label">'.$message['room_number'].'.</span>':'',
						'count' => '<span class="spancount">'.Yii::t('product','Number of properties: {count}.',['count'=>'<b>'.$dataProvider->totalCount.'</b>']).'</span>',
					]);
			?>
		</h3>
		<div class="box-cont">
			<ul class="clearfix">
				<?php 
				echo ListView::widget([
					'dataProvider' => $dataProvider,
					'itemView' => '_item',
					'layout' => "{items}\n{pager}",
					'viewParams' => [
						'listProvinces' => $listProvinces,
						'listDistricts' => $listDistricts,
						'listCates' => $listCates,
						'priceType' => $priceType
					]
				]);?>
			</ul>
		</div>
	</div>
	<div class="box page page_controll nobor position tc">
		<span id="PH_Container_ProductSearchResult_ProductsPager"></span>
	</div>
</div>							
<?php ActiveForm::end(); ?>
