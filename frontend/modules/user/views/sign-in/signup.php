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
		<div class="fl wr_select">
			<?= $form->field($profile, 'dob')->widget('trntv\yii\datetimepicker\DatetimepickerWidget',['phpDatetimeFormat'=>'dd.MM.yyyy']) ?>
		</div>
		<div class="fl wr_select ml20">

			<?= $form->field($profile, 'gender')->widget(\kartik\select2\Select2::classname(), [
					'data' => [
			\common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Female'),
			\common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Male')
		],
					'theme'=>'krajee',
				]);?>
		</div>
		
		<label class="control-label" for="signupform-province"><?= Yii::t('product', 'Address')?></label>		
		<div class="fl wr_select">
			<?= $form->field($profile, 'province')->label(false)->widget(\kartik\select2\Select2::classname(), [
					'data' => common\models\Province::getProvinceList(),
					'options' => ['placeholder' =>  Yii::t('product', 'City/Province')],
					'theme'=>'krajee',
					'pluginOptions'=>['allowClear'=>true]
//					'pluginEvents' => [
//						"select2:select"=>"function() {console.log('select2-selecting city',this.value);Utils.changeAddress('product',this);}",
//					]
				]);?>
		</div>
		<div class="fl wr_select ml20">
			<?php
				$selectedDistrict = common\models\District::getSelectedDistrict($profile->district);
				echo Html::hiddenInput('district_hidden', $profile->district, ['id'=>'district_hidden']);
				echo $form->field($profile, 'district')->label(false)->widget(kartik\depdrop\DepDrop::classname(), [
					'type'=>kartik\depdrop\DepDrop::TYPE_SELECT2,
					'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
					'data'=> isset($dataSelected['data']['district'])?$dataSelected['data']['district']:[],
//						'data'=> [53=>'Quận 1'],
//						'options' => ['placeholder' =>  Yii::t('product', 'Select District')],
					'pluginOptions'=>[
						'depends'=>['userprofile-province'],
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
		</div>
		<?= $form->field($profile, 'local_address') ?>
		<?= $form->field($profile, 'phone') ?>
		<?= $form->field($profile, 'mobile') ?>
	</div>
	<div class="clearfix mb20">
		<h5 class="bold font15 mb10 blue font-roboto">Thông tin liên hệ</h5>
		<?= $form->field($profile, 'yahoo') ?>
		<?= $form->field($profile, 'skype') ?>
		<?= $form->field($profile, 'intro')->textarea() ?>
	</div>
	<?php echo  $form->field($model, 'captcha')->widget(Captcha::className(),['captchaAction'=>  yii\helpers\Url::to('/site/captcha')]) ?>
	<div class="bt-suces clearfix">
		<?= Html::submitButton('<s class="ic-register-white fl mr5"></s><span class="mt8 fl">'.Yii::t('frontend', 'Signup').'</span>', ['class' => 'bg-blue cursor white bold uppercase font13 nobor pt5 pb5 pl10 pr10 radius', 'name' => 'signup-button']) ?>				
	</div>
</div>

<?php ActiveForm::end(); ?>

