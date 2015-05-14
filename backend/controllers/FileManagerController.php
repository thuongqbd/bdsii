<?php

namespace backend\controllers;

class FileManagerController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
