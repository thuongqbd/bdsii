<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
	<meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
	<script>
		var curLang = '<?php echo substr(Yii::$app->language, 0,2)?>';
		var baseUrl = '<?php echo Yii::$app->urlManagerFrontend->baseUrl?>';
		var message = <?php echo json_encode(\frontend\components\JsResources::jsMessage()); ?>;
	</script>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>

<?php $this->beginBody() ?>
	<div id="contentPanel">
		<div id="top_bar" class="bg_white">
			<div class="main">
				<div class="box-tagein cl5">
					<ul class="clearfix">
						<li><a href="http://dothidiaoc.com/dang-tin-ban-cho-thue-nha-dat.htm" class="bold white"><s class="ic-newsup fl mt3 mr5"></s>Đăng tin</a></li>
						<li class="lang" style="margin: 0">
							<?php
							if(substr(Yii::$app->language, 0,2) == 'vi'){
								echo Html::a('<img src="'.Yii::getAlias('@frontendUrl').'/images/cy-GB.gif"/>', ['site/index','language'=>'en']);
							}else{
								echo Html::a('<img src="'.Yii::getAlias('@frontendUrl').'/images/vietnam.gif"/>', ['site/index','language'=>'vi']);
							}
									
							?>
						</li>
						<?php if(Yii::$app->user->isGuest):?>
						<li><a class="dangnhap " href="<?= Url::to(['/user/sign-in/login'])?>" rel="nofollow"><s class="ic-login fl mt3 mr5"></s><?= Yii::t('frontend', 'Login')?></a></li>
						<li><a class="dangky " href="<?= Url::to(['/user/sign-in/signup'])?>" rel="nofollow"><s class="ic-register fl mt3 mr5"></s><?= Yii::t('frontend', 'Signup')?></a></li>			
						<?php else:?>
						<li style="margin: 0"><a href="<?= Url::to(['/user/sign-in/logout'])?>" rel="nofollow"><s class="ic-cancel fl mt3 mr5"></s></s><?= Yii::t('frontend', 'Logout')?></a></li>
						<li style="margin: 0"><a href="<?= Url::to(['/user/default/profile'])?>" rel="nofollow"><s class="ic-login fl mt3 mr5"></s></s><?= \common\models\UserProfile::findOne(Yii::$app->user->id)->fullname?></a></li>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>		
		<div id="header" class="bg_white">
			<div class="main pt10 pb10 clearfix">
				<h1 class="logo">
					<?= Html::a('<img src="'.Yii::getAlias('@frontendUrl').'/images/logo.png" alt="dothidiaoc.com">', Yii::getAlias('@frontendUrl')) ?>
				</h1>
				<div id="banner_top" class="banner w-650 fr"><a href="http://vpbank.com.vn/" rel="nofollow" target="_blank"><img src="<?php echo Yii::getAlias('@frontendUrl')?>/images/vpbank.png"></a></div>
			</div>
		</div>
		<?= frontend\components\widgets\TopMenu::widget()?>
		 <?= $content ?>
		<div id="menu-footer">
			<div class="main bg_white pl20 pr20 pt10 pb10">
				<ul class="navi-footer clearfix font-roboto">
					<li><a href="http://dothidiaoc.com/gioi-thieu.htm" rel="nofollow">Giới thiệu</a></li>
					<li><a href="http://dothidiaoc.com/quy-dinh.htm" rel="nofollow">Quy định</a></li>
					<li><a href="http://dothidiaoc.com/huong-dan.htm" rel="nofollow">Hướng dẫn sử dụng</a></li>
					<li class="last"><a href="http://dothidiaoc.com/lien-he.htm" rel="nofollow">Liên hệ</a></li>
				</ul>
			</div>
		</div>
			
		<div id="footer">
			<div class="main pt20 pb20 clearfix">
				<div class="w-40-100 fl">
					<label class="logo-footer mb10">
					<a href="./dothidiaoc.com_files/dothidiaoc.com.html" title="Đô thị địa ốc">
					<img src="<?php echo Yii::getAlias('@frontendUrl')?>/images/logo-footer.png" alt="dothidiaoc.com"></a>
					</label>
					<h5 class="white font14 pt5">CÔNG TY CỔ PHẦN NHÀ ĐẤT TRƯỜNG PHÚC</h5>
					<label class="adress mt10 pt10 font13 bold">
					Địa chỉ: Phòng 101, Tầng 10, tòa nhà Viglacera, Mễ trì, 
					Từ liêm, Hà Nội - Hotline: 090-626-5502
					</label>
				</div>
				<div class="copyright w-60-100 fl pl20 mt40 pt20">
					<label class="mb5">
					Email: <a rel="nofollow" href="mailto:cskh@dothidiaoc.com?Subject=contact-dothidiaoc.com" target="_top">cskh@dothidiaoc.com
					</a>| Skype: <a rel="nofollow" href="skype:dothidiaoc.cskh?chat">dothidiaoc.cskh
					</a>| Yahoo: <a rel="nofollow" href="ymsgr:sendim?cskh_dothidiaoc">cskh_dothidiaoc
					</a>
					</label>
					<label class="mb5">Bản quyền ©2010 dothidiaoc.com. Website được vận hành bởi VCD Team</label>
					<label class="mb5">Website Dothidiaoc.com đã được bảo hộ độc quyền nhãn hiệu số 171/2011/QTG.</label>
					<label class="mb5">Giấy phép thiết lập Trang tin điện tử tổng hợp số 77/GP-ICP-STTT Cấp ngày 4 tháng 10 năm 2012.</label>
					<label class="mb5">
					<a target="_blank" href="http://infotivi.net/" title="Mua bán nhà đât">Mua bán nhà đất</a>
					<a href="http://dothidiaoc.com/cho-thue-nha-rieng.htm" title="Cho thuê nhà nguyên căn">Cho thuê nhà nguyên căn</a>
					<a target="_blank" href="http://banxehoi.com/ban-xe" title="Mua bán ô tô">Mua bán ô tô</a>
					<a target="_blank" href="http://banxehoi.com/danh-gia-xe" title="Đánh giá xe">Đánh giá xe</a>
					<a target="_blank" href="http://banxehoi.com/" title="Xe ô tô cũ">Xe ô tô cũ</a></label>
				</div>
			</div>
		</div>	
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
