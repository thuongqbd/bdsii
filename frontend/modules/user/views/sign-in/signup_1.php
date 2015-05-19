<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
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
				<?= $form->field($model, 'username') ?>
				<?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'password_repeat')->passwordInput() ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($profile, 'fullname') ?>
				<?= $form->field($profile, 'dob') ?>
				<?= $form->field($profile, 'gender') ?>
				<div class="fl wr_select">
					<?= $form->field($profile, 'province') ?>
				</div>
				<div class="fl wr_select ml20">
					<?= $form->field($profile, 'district') ?>
				</div>
				<?= $form->field($profile, 'local_address') ?>
				<?= $form->field($profile, 'phone') ?>
				<?= $form->field($profile, 'mobile') ?>
			</div>
			<div class="clearfix mb20">
				<h5 class="bold font15 mb10 blue font-roboto">Thông tin liên hệ</h5>
				<?= $form->field($profile, 'yahoo') ?>
				<?= $form->field($profile, 'skype') ?>
				<?= $form->field($profile, 'intro') ?>
			</div>
			<?php //  $form->field($model, 'captcha')->widget(Captcha::className(),['captchaAction'=>  yii\helpers\Url::to('/site/captcha')]) ?>
			<div class="bt-suces clearfix">
				<?= Html::submitButton('<s class="ic-register-white fl mr5"></s><span class="mt8 fl">'.Yii::t('frontend', 'Signup').'</span>', ['class' => 'bg-blue cursor white bold uppercase font13 nobor pt5 pb5 pl10 pr10 radius', 'name' => 'signup-button']) ?>				
			</div>
		</div>
		
		<?php ActiveForm::end(); ?>
	</div>
</div>
