<?php
namespace frontend\components\widgets;

use Yii;

class UserPanel extends \yii\base\Widget
{
    /**
     * @var string text block key
     */
    public $key;

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('UserPanel');
    }
}


