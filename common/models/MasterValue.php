<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_value".
 *
 * @property integer $master_value_id
 * @property string $locale
 * @property string $value_code
 * @property string $value
 * @property integer $order_num
 * @property string $description
 * @property string $label
 */
class MasterValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locale', 'value_code', 'value', 'order_num'], 'required'],
            [['order_num'], 'integer'],
            [['locale'], 'string', 'max' => 5],
            [['value_code', 'value'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
            [['label'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'master_value_id' => Yii::t('master_value', 'Master Value ID'),
            'locale' => Yii::t('master_value', 'Locale'),
            'value_code' => Yii::t('master_value', 'Value Code'),
            'value' => Yii::t('master_value', 'Value'),
            'order_num' => Yii::t('master_value', 'Order Num'),
            'description' => Yii::t('master_value', 'Description'),
            'label' => Yii::t('master_value', 'Label'),
        ];
    }
}
