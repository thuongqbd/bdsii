<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="box_register" class="box register margin-center w-650 mt50">
	<div class="title-tabs bor-bot-blue4 font-roboto position">
		<ul class="clearfix">
			<li class="font15 uppercase fl"><a class="active" href="#"><?= Html::encode($this->title) ?></a></li>
		</ul>
		<img class="buiding-shadow w-50-100" alt="dothidiaoc.com" src="images/buiding-shadow.png">
	</div>
	<div class="box-cont pt30 pb30 pl80 pr80 bor-left bor-right bor-bot">
		<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
		<div id="pnBox">
			<h6 class="clearfix mb20 orange font12">Mời Quý vị đăng ký thành viên để được hưởng nhiều lợi ích và hỗ trợ từ chúng tôi!
			</h6>
			<div class="clearfix mb30">
				<h5 class="bold font15 mb10 blue font-roboto">Thông tin cá nhân</h5>
				<ul class="clearfix">
					<li class="mb20 clearfix">
						<?= $form->field($model, 'username') ?>
					</li>
					
					<li class="mb20 clearfix">
						 <?= $form->field($model, 'password')->passwordInput() ?>
					</li>
					<li class="mb20 clearfix">
						<?= $form->field($model, 'email') ?>
					</li>
					<li class="mb20 clearfix">
						 <?= $form->field($profile, 'fullname') ?>
					</li>
					<li class="mb20 clearfix">
						<?= $form->field($profile, 'dob') ?>
					</li>
					<li class="mb20 clearfix">
						<?= $form->field($profile, 'gender') ?>
					</li>
					<li class="mb20 clearfix">
						<div class="fl wr_select">
							<?= $form->field($profile, 'province') ?>
						</div>
						<div class="fl wr_select ml20">
							<?= $form->field($profile, 'district') ?>
						</div>
					</li>
					<li class="mb20 clearfix">
						 <?= $form->field($profile, 'local_address') ?>
					</li>
					<li class="mb20 clearfix">
						 <?= $form->field($profile, 'phone') ?>
					</li>
					<li class="mb20 clearfix">
						 <?= $form->field($profile, 'mobile') ?>
					</li>
				</ul>
			</div>
			<div class="clearfix mb20">
				<h5 class="bold font15 mb10 blue font-roboto">Thông tin liên hệ</h5>
				<ul class="clearfix">
					<li class="mb20 clearfix">
						<?= $form->field($profile, 'yahoo') ?>
					</li>
					<li class="mb20 clearfix">
						<?= $form->field($profile, 'skype') ?>
					</li>
					
					<li class="mb20 clearfix">
						<label class="w-20-100 fl mt5">Mã đăng ký</label>
						<div class="w-80-100 fl pl20">
							<span class="capchar mr20 fl border-green2" style="width:100px">
							<img id="img_CAPTCHA_RESULT_314" style="width: 100px; height: 23px; vertical-align: middle;" src="/Layout/Capchar/CaptchaGenerator.aspx" alt="dothidiaoc.com" noloaderror="1">
							</span>
							<a class="refresh-capchar cursor fl mt5" onclick="javascript:refreshCaptcha('img_CAPTCHA_RESULT_314');" title="Đổi mã an toàn"><s class="ic-refresh"></s></a>
						</div>
					</li>
					<li class="mb20 clearfix">
						<input name="ctl00$PH_Container$Register1$txtcode" type="text" maxlength="4" id="txtcode" placeholder="Nhập mã đăng ký" class="w-50-100 gray border-green2">
					</li>
					<li class="hidden">
						<label class="w-20-100 fl mt10">Đồng ý với điều khoản website</label>
						<span class="chkbox"><input id="chkAgree" type="checkbox" name="ctl00$PH_Container$Register1$chkAgree" checked="checked"><label for="chkAgree">Tôi đồng ý</label></span>
					</li>
				</ul>
			</div>
			<div class="bt-suces clearfix">
				<?= Html::submitButton('<s class="ic-register-white fl mr5"></s><span class="mt8 fl">'.Yii::t('frontend', 'Signup').'</span>', ['class' => 'bg-blue cursor white bold uppercase font13 nobor pt5 pb5 pl10 pr10 radius', 'name' => 'signup-button']) ?>				
			</div>
		</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
