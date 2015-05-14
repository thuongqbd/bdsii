<?php
namespace common\components\widgets;

use Yii;

class HotProjects extends \yii\base\Widget
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
        return $this->render('HotProjects');
    }
}


