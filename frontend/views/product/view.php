<?php
use common\components\MasterValues;
use yii\helpers\Html;
?>
<div class="box detail-news mb20 clearfix">
	<div class="title-detail mb20 position">
		<h1 class="bold mb10 font18 blue">
			<?= yii\helpers\Html::encode($model->title)?>
		</h1>
		<div id="PH_Container_ProductDetail1_divprice" class="divprice">
			<label class="font15 mb5 orange bold">
				<span class="spanprice"><?= Yii::t('product','Price')?>:
					<?php 
					if($model->price_type){
						echo $model->price .' '.MasterValues::itemByValue($model->product_type==MasterValues::MV_PT_FOR_SALE?MasterValues::MV_PRICE_TYPE_SALE_CODE:MasterValues::MV_PRICE_TYPE_RENT_CODE, $model->price_type);
					}else{
						echo MasterValues::itemByValue($model->product_type==MasterValues::MV_PT_FOR_SALE?MasterValues::MV_PRICE_TYPE_SALE_CODE:MasterValues::MV_PRICE_TYPE_RENT_CODE, 0);
					}
					?>
				</span>
			<span class="spanarea ml20">Diện tích:
			62&nbsp;m²</span>
			</label>
		</div>
		<div id="PH_Container_ProductDetail1_divlocation" class="divlocation">
			<h2 class="location">
				<span class="spanlocation">Khu vực:</span>  <a href="http://dothidiaoc.com/ban-can-ho-chung-cu-chung-cu-10a-tran-nhat-duat.htm">Bán căn hộ chung cư tại Chung cư 10A Trần Nhật Duật</a> - Quận 1 - Hồ Chí Minh
			</h2>
		</div>
	</div>
	<div class="mb20">
		<div class="titlebox">
			<h4 class="tt"><?= Yii::t('product','Description')?></h4>
		</div>
		<div class="description">
			<?= $model->description?>
		</div>
	</div>
	<div id="imgPrint"></div>
	<div class="divcontact">
		<!-- Slide images -->
		<?php if($model->productAttachments):?>
		<div class="divslide" id="divmyGallery">
			<div class="titlebox">
				<h4 class="tt">Ảnh</h4>
			</div>
			<div id="galleria"  style="height:320px;text-align: center; background: #edebec;">
				<?php foreach ($model->productAttachments as $img):?>
				<?php if (\common\components\Utils::checkExistImage($img->path, $img->base_url)): ?>
					<!--<li style="list-style: none;">-->
						<a href="<?php echo $img->base_url.'/'.$img->path ;?>">
					<?php echo Html::img(
						Yii::$app->glide->createSignedUrl([
							'glide/index',
							'path' => $img->path,
							'w' => 200
						], true)
					) ?>
						</a>
					<!--</li>-->
				<?php endif; ?>
				<?php endforeach;?>
			</div>
			<?php echo \thuongqbd\galleria\Galleria::widget()?>
		</div>
		<?php endif;?>
		<div class="description mb20">
			<div class="description-news mt20 clearfix">
				<div id="info_other" class="box characteristics w-50-100 fl pr10">
					<div class="titlebox">
						<h4 class="tt">Quy mô dự án</h4>
					</div>
					<div class="box-cont">
						<table id="tbl1">
							<tbody>
								<tr>
									<td class="tt"><?= Yii::t('product', 'Product ID')?><span class="tblnote">:</span></td>
									<td class="orange"><?= Html::encode($model->product_id)?></td>
								</tr>						
								<?php 
								$class = 'alt';
								if($model->address): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Address')?><span class="tblnote">:</span></td>
									<td>
										<?= Html::encode($model->address);?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->direction): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Direction')?><span class="tblnote">:</span></td>
									<td>
										<?= MasterValues::itemByValue('direction', $model->direction);?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->balcony_direction): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Balcony Direction')?><span class="tblnote">:</span></td>
									<td>
										<?= MasterValues::itemByValue('direction', $model->balcony_direction);?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->facade): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Facade')?><span class="tblnote">:</span></td>
									<td>
										<?= Html::encode($model->facade.'m');?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->entry_width): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Entry Width')?><span class="tblnote">:</span></td>
									<td>
										<?= Html::encode($model->entry_width.'m');?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->floor_number): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Floor Number')?><span class="tblnote">:</span></td>
									<td>
										<?= Html::encode($model->floor_number);?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->room_number): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Room Number')?><span class="tblnote">:</span></td>
									<td>
										<?= Html::encode($model->room_number);?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->toilet_number): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Toilet Number')?><span class="tblnote">:</span></td>
									<td>
										<?= Html::encode($model->toilet_number);?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<?php if($model->interior): ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Interior')?><span class="tblnote">:</span></td>
									<td>
										<?= $model->interior;?>
									</td>
								</tr>
								<?php 
								$class = $class?'':'alt';
								endif ?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'Start Date')?><span class="tblnote">:</span></td>
									<td>
										<?= Yii::$app->formatter->asDate($model->start_date) ?>
									</td>
								</tr>
								<?php $class = $class?'':'alt';?>
								<tr class="<?= $class;?>">
									<td class="tbltitle"><?= Yii::t('product', 'End Date')?><span class="tblnote">:</span></td>
									<td>
										<?= Yii::$app->formatter->asDate($model->end_date) ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div id="lienhe" class="box characteristics w-50-100 fl pl10">
					<div class="titlebox">
						<h4 class="tt">Liên hệ</h4>
					</div>
					<div class="box-cont">
						<table id="tbl2">
							<tbody>
								<?php
								$class = 'alt';
								if($model->ct_name):
								?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Name')?><span class="tblnote">:</span></td>
										<td>
											<?= Html::encode($model->ct_name);?>
										</td>
									</tr>
									<?php $class = $class?'':'alt';?>
									<?php if($model->ct_address): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Address')?><span class="tblnote">:</span></td>
										<td>
											<?= $model->ct_address;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
									
									<?php if($model->ct_phone): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Phone')?><span class="tblnote">:</span></td>
										<td>
											<?= $model->ct_phone;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
									
									<?php if($model->ct_mobile): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Mobile')?><span class="tblnote">:</span></td>
										<td>
											<?= $model->ct_mobile;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
									
									<?php if($model->ct_email): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Email')?><span class="tblnote">:</span></td>
										<td>
											<?= $model->ct_email;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
								<?php
								elseif($model->author_id && $user = \common\models\User::findOne($model->author_id) ):
									$userProfile = $user->userProfile;
								?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Name')?><span class="tblnote">:</span></td>
										<td>
											<?= Html::encode($userProfile->getFullName());?>
										</td>
									</tr>
									<?php $class = $class?'':'alt';?>
									<?php if($userProfile->address): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Address')?><span class="tblnote">:</span></td>
										<td>
											<?= $userProfile->address;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
									
									<?php if($userProfile->phone): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Phone')?><span class="tblnote">:</span></td>
										<td>
											<?= $userProfile->phone;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
									
									<?php if($userProfile->mobile): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Mobile')?><span class="tblnote">:</span></td>
										<td>
											<?= $userProfile->mobile;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
									
									<?php 
									if($user->email): ?>
									<tr class="<?= $class;?>">
										<td class="tbltitle"><?= Yii::t('product', 'Ct Email')?><span class="tblnote">:</span></td>
										<td>
											<?= $user->email;?>
										</td>
									</tr>
									<?php 
									$class = $class?'':'alt';
									endif ?>
								<?php
								endif;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- Maps -->
	<div id="PH_Container_ProductDetail1_divmaps" class="divmaps">
		<div class="titlebox">
			<h4 class="tt">Bản đồ</h4>
		</div>
		<div>
			<?php echo Html::hiddenInput('Product[lat]', $model->lat,['id'=>'product-lat']) ?>
			<?php echo Html::hiddenInput('Product[lng]', $model->lng,['id'=>'product-lng']) ?>					
			<?php echo thuongqbd\googlemap\GoogleMapWidget::widget(
				['lat'=>$model->lat,'lng'=>$model->lng,'height'=>'430px','resultContainers'=>["lat"=>"product-lat","lng"=>"product-lng","address"=>""]]
			)?>
		</div>
	</div>
	<!-- Share -->
	<div class="divshare">
		<a href="javascript:printDetail();" class="print" rel="nofollow">In bài này</a>
		<a id="saveNews" rel="nofollow" onclick="productSaved(this,'1903101');" class="save">Lưu tin</a>
<!--		[if !IE] 
		<div class="fl mt5 ml10">
			<script type="text/javascript" src="./view_files/addthis_widget.js"></script>
			<div class="addthis_native_toolbox" data-url="http://dothidiaoc.com/ban-can-ho-chung-cu-chung-cu-10a-tran-nhat-duat/ban-can-ho-chung-cu-10a-tran-nhat-duat-phuong-tan-dinh-quan-1-dt-62m2-gia-1-5-ty-pr1903101.htm" data-title="Bán chung cư 10A Trần Nhật Duật, Phường Tân Định, Q.1. diện tích 62m2, giá 1.5 tỷ. Liên hệ: 0938177289 | dothidiaoc.com">
				<div id="atstbx" class="at-share-tbx-element addthis_default_style addthis_20x20_style addthis-smartlayers addthis-animated at4-show">
					<a class="addthis_button_facebook_like at300b" fb:like:layout="button_count">
						<div class="fb-like fb_iframe_widget" data-ref=".VVimf1latWs.like" data-layout="button_count" data-show_faces="false" data-share="false" data-action="like" data-width="90" data-font="arial" data-href="file:///C:/Users/Thuong/Desktop/dothidiaoc/view.html" data-send="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=172525162793917&amp;container_width=0&amp;font=arial&amp;href=file%3A%2F%2F%2FC%3A%2FUsers%2FThuong%2FDesktop%2Fdothidiaoc%2Fview.html&amp;layout=button_count&amp;locale=vi_VN&amp;ref=.VVimf1latWs.like&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90"><span style="vertical-align: top; width: 0px; height: 0px; overflow: hidden;"><iframe name="f5a0eb028" width="90px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/v2.0/plugins/like.php?action=like&amp;app_id=172525162793917&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FNM7BtzAR8RM.js%3Fversion%3D41%23cb%3Df7f0ca178%26domain%3D%26origin%3Dfile%253A%252F%252F%252Ff35f7f92ec%26relation%3Dparent.parent&amp;container_width=0&amp;font=arial&amp;href=file%3A%2F%2F%2FC%3A%2FUsers%2FThuong%2FDesktop%2Fdothidiaoc%2Fview.html&amp;layout=button_count&amp;locale=vi_VN&amp;ref=.VVimf1latWs.like&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90" style="border: none; visibility: visible; width: 0px; height: 0px;"></iframe></span></div>
					</a>
					<a class="addthis_button_google_plusone at300b" g:plusone:size="medium">
						<div id="___plusone_0" style="text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 90px; height: 20px; background: transparent;"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 90px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 20px;" tabindex="0" vspace="0" width="100%" id="I0_1431873057386" name="I0_1431873057386" src="./view_files/fastbutton.html" data-gapiattached="true" title="+1"></iframe></div>
						<div id="___plusone_0" style="position: absolute; width: 450px; left: -10000px;"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position:absolute;top:-10000px;width:450px;margin:0px;border-style:none" tabindex="0" vspace="0" width="100%" id="I0_1431873151606" name="I0_1431873151606" src="https://apis.google.com/se/0/_/+1/fastbutton?usegapi=1&amp;size=medium&amp;hl=en-US&amp;origin=file%3A%2F%2F&amp;url=file%3A%2F%2F%2FC%3A%2FUsers%2FThuong%2FDesktop%2Fdothidiaoc%2Fview.html&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.vi.0IrwDIvuBgg.O%2Fm%3D__features__%2Fam%3DAQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAGLTcCPfBIQrcLChd0rPd71uHxJUpsKDew#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh&amp;id=I0_1431873151606&amp;parent=file%3A%2F%2F&amp;pfname=&amp;rpctoken=26645943" data-gapiattached="true"></iframe></div>
						<g:plusone size="medium" lang="null" href="file:///C:/Users/Thuong/Desktop/dothidiaoc/view.html" callback="_at_plusonecallback" data-gapiscan="true" data-gapistub="true"></g:plusone>
					</a>
					<a class="addthis_counter addthis_pill_style" href="http://dothidiaoc.com/ban-can-ho-chung-cu-chung-cu-10a-tran-nhat-duat/ban-can-ho-chung-cu-10a-tran-nhat-duat-phuong-tan-dinh-quan-1-dt-62m2-gia-1-5-ty-pr1903101.htm#" style="display: inline-block;"></a><a class="atc_s addthis_button_compact at300m" href="#"><span></span></a><a class="addthis_button_expanded at300m" target="_blank" title="Thêm..." href="http://dothidiaoc.com/ban-can-ho-chung-cu-chung-cu-10a-tran-nhat-duat/ban-can-ho-chung-cu-10a-tran-nhat-duat-phuong-tan-dinh-quan-1-dt-62m2-gia-1-5-ty-pr1903101.htm#"><span class="at4-icon aticon-expanded" style="background-color: rgb(252, 109, 76);"><span class="at_a11y">More Sharing Services</span></span></a>
					<div class="atclear"></div>
				</div>
			</div>
		</div>
		[endif]     -->
	</div>
</div>