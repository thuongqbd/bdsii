<?php
namespace backend\controllers;

use Yii;

/**
 * Site controller
 */
class SiteController extends \backend\components\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
			'set-locale'=>[
                'class'=>'common\components\action\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest ? 'base' : 'common';
        return parent::beforeAction($action);
    }
}
