<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ward".
 *
 * @property integer $id
 * @property string $name
 * @property string $prefix
 * @property string $alias
 * @property integer $district_id
 * @property integer $province_id
 */
class Ward extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ward';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'prefix', 'alias', 'district_id', 'province_id'], 'required'],
            [['district_id','province_id'], 'integer'],
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
            'district_id' => Yii::t('common', 'District ID'),
			'province_id' => Yii::t('common', 'Province ID'),
        ];
    }
	
	public static function getWardList($location,$wardId=null) {
		$model = self::findAll($location);		
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		$out = ['output'=>[],'selected'=>''];
		foreach ($model as $value) {
			$tmp['id'] = $value->id;
			$tmp['name'] = $justStripDiacritic?\common\components\Utils::stripUnicode ($value->prefix.' '.$value->name,true):$value->prefix.' '.$value->name;
			$out['output'][] = $tmp;
		}
		if($wardId)
			$out['selected'] = $wardId;
		return $out;
	}
	
	public static function getSelectedWard($wardId) {
		$model = self::findOne(['id' => $wardId]);
		$justStripDiacritic = substr(\Yii::$app->language, 0,2) != 'vi'?true:false;
		return $model?[$model->id=>$justStripDiacritic?\common\components\Utils::stripUnicode ($model->name,true):$model->name]:[];
	}
}
