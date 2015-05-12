<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "street".
 *
 * @property integer $id
 * @property string $name
 * @property string $prefix
 * @property string $alias
 * @property integer $district_id
 * @property integer $province_id
 */
class Street extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'street';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'prefix', 'alias', 'province_id','district_id'], 'required'],
            [['province_id','district_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['prefix'], 'string', 'max' => 30],
            [['alias'], 'string', 'max' => 130]
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
            'prefix' => Yii::t('common', 'Prefix'),
            'alias' => Yii::t('common', 'Alias'),
            'province_id' => Yii::t('common', 'Province ID'),
			'district_id' => Yii::t('common', 'District ID'),
        ];
    }
	
	public static function getStreetList($location,$streedId=null) {
		$model = self::findAll($location);		
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		$out = ['output'=>[],'selected'=>''];
		foreach ($model as $value) {
			$tmp['id'] = $value->id;
			$tmp['name'] = $justStripDiacritic?\common\components\Utils::stripUnicode ($value->name,true):$value->name;
			$out['output'][] = $tmp;
		}
		if($streedId)
			$out['selected'] = $streedId;
		return $out;
	}
	
	public static function getSelectedStreet($streedId) {
		$model = self::findOne(['id' => $streedId]);
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		return $model?[$model->id=>$justStripDiacritic?\common\components\Utils::stripUnicode ($model->name,true):$model->name]:[];
	}
}
