<?php
namespace common\components;

use Yii;
use yii\bootstrap\Dropdown;

class LanguageDropdown extends Dropdown
{
    public function init()
    {
        $route = '/'.Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;

        array_unshift($params, $route);

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildCard = substr($language, -2)==='-*';
            if (
                $language===$appLanguage ||
                // Also check for wildcard language
                $isWildCard && substr($appLanguage,0,2)===substr($language,0,2)
            ) {
                continue;   // Exclude the current language
            }
            if ($isWildCard) {
                $language = substr($language,0,2);
            }
            $params['language'] = $language;
            $this->items[] = [
                'label' => \Yii::$app->params['availableLocales'][$language],
                'url' => $params,
            ];
        }
        parent::init();
    }
}