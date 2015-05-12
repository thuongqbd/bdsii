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
		$model = self::find()->orderBy('order')->all();
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		$out = [];
		foreach ($model as $value) {
			$out[$value->id] = $justStripDiacritic?\common\components\Utils::stripUnicode ($value->name,true):$value->name;
		}
		return $out;
	}
}
