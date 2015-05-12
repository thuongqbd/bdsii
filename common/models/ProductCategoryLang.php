<?php

namespace common\models;


use Yii;
use yii\behaviors\SluggableBehavior;
use common\components\ActiveRecord;
/**
 * This is the model class for table "product_category_lang".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $language
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $keyword
 *
 * @property ProductCategory $category
 */
class ProductCategoryLang extends ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category_lang';
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title',
                'immutable' => true
            ],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'language', 'title', 'slug'], 'required'],
            [['category_id'], 'integer'],
            [['language'], 'string', 'max' => 6],
            [['title', 'slug', 'description', 'keyword'], 'string', 'max' => 255]
        ];
    }

   /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product_category', 'ID'),
            'category_id' => Yii::t('product_category', 'Category ID'),
            'language' => Yii::t('product_category', 'Language'),
            'title' => Yii::t('product_category', 'Title'),
            'slug' => Yii::t('product_category', 'Slug'),
            'description' => Yii::t('product_category', 'Description'),
            'keyword' => Yii::t('product_category', 'Keyword'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['category_id' => 'category_id']);
    }
	
}
