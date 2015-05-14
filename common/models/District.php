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

		$key = 'district_prov_'.Yii::$app->language.'_'.$provinceId;
		$model = \Yii::$app->cache->get($key);
		if ($model === false){
			$model = self::findAll(['province_id' => $provinceId]);
			if($model){
				 \Yii::$app->cache->set($key, $model,  \Yii::$app->params['cacheExpire']['location']);
			}
			
		}
		$out = ['output'=>[],'selected'=>''];
		foreach ($model as $value) {
			$tmp['id'] = $value->id;
			$tmp['name'] = substr(\Yii::$app->language, 0,2) == 'vi'?$value->name:$value->name_en;
			$out['output'][] = $tmp;
		}
		if($selectedId)
			$out['selected'] = $selectedId;
		return $out;
	}
	
	public static function getSelectedDistrict($districtId) {
		$model = self::findOne(['id' => $districtId]);
		return $model?[$model->id=>substr(\Yii::$app->language, 0,2) == 'vi'?$model->name:$model->name_en]:[];
	}
}
