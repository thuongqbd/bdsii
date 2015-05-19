<?php
namespace frontend\components\widgets;

use Yii;

class TopNews extends \yii\base\Widget
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
        return $this->render('TopNews');
    }
}


