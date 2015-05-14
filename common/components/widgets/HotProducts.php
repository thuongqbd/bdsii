<?php
namespace common\components\widgets;

use Yii;

class HotProducts extends \yii\base\Widget
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
        return $this->render('HotProducts');
    }
}


