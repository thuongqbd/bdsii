<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property integer $province_id
 */
class District extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'province_id'], 'required'],
            [['province_id'], 'integer'],
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
            'name' => Yii::t('common', 'Name'),
            'alias' => Yii::t('common', 'Alias'),
            'province_id' => Yii::t('common', 'Province ID'),
        ];
    }
	
	public static function getDistrictList($provinceId,$selectedId = null) {
		$model = self::findAll(['province_id' => $provinceId]);
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		$out = ['output'=>[],'selected'=>''];
		foreach ($model as $value) {
			$tmp['id'] = $value->id;
			$tmp['name'] = $justStripDiacritic?\common\components\Utils::stripUnicode ($value->name,true):$value->name;
			$out['output'][] = $tmp;
		}
		if($selectedId)
			$out['selected'] = $selectedId;
		return $out;
	}
	
	public static function getSelectedDistrict($districtId) {
		$model = self::findOne(['id' => $districtId]);
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		return $model?[$model->id=>$justStripDiacritic?\common\components\Utils::stripUnicode ($model->name,true):$model->name]:[];
	}
}
