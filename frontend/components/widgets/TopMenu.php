<?php
namespace frontend\components\widgets;

use Yii;

class TopMenu extends \yii\widgets\Menu
{

    public function run()
    {
        return $this->render('TopMenu');
    }
}
