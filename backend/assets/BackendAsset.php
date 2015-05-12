<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $basePath = '/';
    public $baseUrl = '@backendUrl';

    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/app.js',
		'js/utils.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'common\assets\AdminLte',
        'common\assets\Html5shiv'
    ];
	
	/**
     * Registers the CSS and JS files with the given view.
     * @param \yii\web\View $view the view that the asset files are to be registered with.
     */
    public function registerAssetFiles($view)
    {
		$baseUrl = \Yii::getAlias('@backendUrl');
		$view->registerJs("var baseUrl = '".$baseUrl."';",1);
		return parent::registerAssetFiles($view);
    }
}
