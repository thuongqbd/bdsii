<?php

namespace backend\controllers;

class FileManagerController extends \common\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
