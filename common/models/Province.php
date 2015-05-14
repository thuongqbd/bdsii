<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $alias
 * @property integer $order
 */
class Province extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'alias', 'order'], 'required'],
            [['order'], 'integer'],
            [['code'], 'string', 'max' => 4],
            [['name', 'alias'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'code' => Yii::t('common', 'Code'),
            'name' => Yii::t('common', 'Name'),
            'alias' => Yii::t('common', 'Alias'),
            'order' => Yii::t('common', 'Order'),
        ];
    }
	
	public static function getProvinceList() {
		$key = 'province_'.Yii::$app->language;
		$model = \Yii::$app->cache->get($key);
		if ($model === false){
			$model = self::find()->orderBy('order')->all();
			if($model){
				 \Yii::$app->cache->set($key, $model,  \Yii::$app->params['cacheExpire']['location']);
			}
			
		}
		$out = [];
		foreach ($model as $value) {
			$out[$value->id] = substr(\Yii::$app->language, 0,2) == 'vi'? $value->name:$value->name_en;
		}
		return $out;
	}
}
