<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/_base.php')
?>
	<div id="container">
		<div class="main bg_white pd20 clearfix">
			<?php echo common\components\widgets\SearchBox::widget()?>
			<div class="w-650 fl" id="leftPanel">
				<?= $content ?>
			</div>
			<div class="w-280 fr" id="rightPanel">
				<?php echo common\components\widgets\HotProjects::widget()?>
			</div>
			<div class="clear"></div>
			
		</div>
	</div>	
<?php $this->endContent() ?>