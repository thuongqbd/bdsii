<?php
namespace common\components;

use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
	public function init() {
//		$this->loadDefaultValues();
		return parent::init();
	}
}