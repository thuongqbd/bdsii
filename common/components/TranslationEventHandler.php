<?php

namespace common\components;

use yii\i18n\MissingTranslationEvent;

class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event) {
		
		if(get_class($event->sender) == 'yii\i18n\DbMessageSource'){
			$db = $event->sender->db;
			$checkExits = $db->createCommand('SELECT * FROM {{%i18n_source_message}} WHERE category LIKE "'.$event->category.'" AND message LIKE "'.$event->message.'"')->queryOne();
			if(!$checkExits){
				$db->createCommand()
							->insert('{{%i18n_source_message}}', ['category' => $event->category, 'message' => $event->message])->execute();
				$lastId = $db->getLastInsertID($db->driverName == 'pgsql' ? 'i18n_source_message_id_seq' : null);
				foreach (\Yii::$app->params['availableLocales'] as $key => $value) {
					$db->createCommand()
							->insert('{{%i18n_message}}', ['id' => $lastId, 'language' => $key, 'translation'=>$event->message])->execute();
				}

			}
		}
//        $event->translatedMessage = "@MISSING: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @";
    }
}