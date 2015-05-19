<?php
/* @var $this \yii\web\View */
//use yii\helpers\ArrayHelper;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_base.php')
?>
	<div id="container">
		<div class="main bg_white pd20 clearfix">
			<?php if(!Yii::$app->user->isGuest):?>
			<div class="box register margin-center mt50 mb30">
				<div class="title-tabs bor-bot-blue4 font-roboto position">
					<ul class="clearfix">
						<li class="font15 uppercase fl"><a class="active"><?= Html::encode($this->title) ?></a></li>
					</ul>
					<img class="buiding-shadow w-30-100" alt="dothidiaoc.com" src="<?= Yii::getAlias('@frontendUrl')?>/images/buiding-shadow.png">
				</div>
				
				<div class="pd20 bor-left bor-right bor-bot value-newsup clearfix">
					<div class="w-630 pr20 fl">
							<?= $content ?>
					</div>
					<?php echo \frontend\components\widgets\UserPanel::widget()?>
				</div>				
			</div>
			<?php else:?>
			<div id="box_register" class="box register margin-center w-650 mt50">
				<div class="title-tabs bor-bot-blue4 font-roboto position">
					<ul class="clearfix">
						<li class="font15 uppercase fl"><a class="active" href="#"><?= Html::encode($this->title) ?></a></li>
					</ul>
					<img class="buiding-shadow w-50-100" alt="dothidiaoc.com" src="<?= Yii::getAlias('@frontendUrl')?>/images/buiding-shadow.png">
				</div>
				<div class="box-cont pt30 pb30 pl80 pr80 bor-left bor-right bor-bot">
					<?= $content ?>
				</div>
			</div>
			<?php endif;?>
			<div class="clear"></div>
			
		</div>
	</div>	
<?php $this->endContent() ?>