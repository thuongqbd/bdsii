<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components;

use Yii;
use yii\base\InvalidConfigException;

/**
 * I18N provides features related with internationalization (I18N) and localization (L10N).
 *
 * I18N is configured as an application component in [[\yii\base\Application]] by default.
 * You can access that instance via `Yii::$app->i18n`.
 *
 * @property MessageFormatter $messageFormatter The message formatter to be used to format message via ICU
 * message format. Note that the type of this property differs in getter and setter. See
 * [[getMessageFormatter()]] and [[setMessageFormatter()]] for details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
/* @var $db yii\db\Connection */

class I18N extends \yii\i18n\I18N
{
	public $igronLangs = ['en'];
	
    public function translate($category, $message, $params, $language)
    {
        $messageSource = $this->getMessageSource($category);
        $translation = $messageSource->translate($category, $message, $language);
        if ($translation === false) {
			$this->insertNewMessage($category, $message, $language);
            return $this->format($message, $params, $messageSource->sourceLanguage);
        } else {
            return $this->format($translation, $params, $language);
        }
    }
	
	private function insertNewMessage($category, $message, $language){

		if(array_key_exists($category, $this->translations)){
			$translations = $this->translations[$category];
		}else{
			$translations = $this->translations['*'];
		}
		if(get_class($translations) == 'yii\i18n\DbMessageSource'){
			
			$db = $translations->db;
			$checkExits = $db->createCommand('SELECT * FROM {{%i18n_source_message}} WHERE category LIKE "'.$category.'" AND message LIKE "'.$message.'"')->queryOne();
			if(!$checkExits){
				$db->createCommand()
                            ->insert('{{%i18n_source_message}}', ['category' => $category, 'message' => $message])->execute();
				$lastId = $db->getLastInsertID($db->driverName == 'pgsql' ? 'i18n_source_message_id_seq' : null);
				foreach (\Yii::$app->params['availableLocales'] as $key => $value) {
					$db->createCommand()
							->insert('{{%i18n_message}}', ['id' => $lastId, 'language' => $key, 'translation'=>$message])->execute();
				}
				
			}
			
		}
	}
}
