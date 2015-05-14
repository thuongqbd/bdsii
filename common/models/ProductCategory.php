<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\components\ActiveRecord;
/**
 * This is the model class for table "product_category".
 *
 * @property integer $category_id
 * @property string $title
 * @property string $slug
 * @property integer $parent_id
 * @property integer $product_type
 * @property string $description
 * @property string $keyword
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $order_num
 * @property integer $published
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $updated_at
 */
class ProductCategory extends ActiveRecord
{
	public $thumbnail;
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title',
                'immutable' => true
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
			'ml' => [
				'class' => \omgdef\multilingual\MultilingualBehavior::className(),
				'languages' => \Yii::$app->params['availableLocales'],
				//'languageField' => 'language',
				//'localizedPrefix' => '',
				//'forceOverwrite' => false',
				//'dynamicLangClass' => true',
//				'langClassName' => ProductCategoryLang::className(), // or namespace/for/a/class/PostLang
				'defaultLanguage' => \Yii::$app->params['defaultLanguage'],
				'langForeignKey' => 'category_id',
				'tableName' => "{{%product_category_lang}}",
				'attributes' => [
					'title', 'description','keyword','slug'
				],
				'extendBehavior'=>[					
					'class'=>SluggableBehavior::className(),
					'attribute'=>'title',
					'immutable' => true
				]
			],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'product_type'], 'required'],
            [['parent_id', 'product_type', 'order_num', 'published', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'description', 'keyword'], 'string', 'max' => 255],
			[['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
			[['thumbnail'], 'safe'],
			[['parent_id'],'default','value'=>0],
			[['order_num'],'default','value'=>0],
			[['published'],'default','value'=>0],
			[['deleted'],'default','value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('product_category', 'Category ID'),
            'title' => Yii::t('product_category', 'Title'),
            'slug' => Yii::t('product_category', 'Slug'),
            'parent_id' => Yii::t('product_category', 'Parent ID'),
            'product_type' => Yii::t('product_category', 'Type'),
            'description' => Yii::t('common', 'Description'),
            'keyword' => Yii::t('common', 'Keyword'),
            'thumbnail' => Yii::t('product_category', 'Thumbnail'),
            'order_num' => Yii::t('common', 'Order'),
            'published' => Yii::t('common', 'Published'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
	
	public static function getList($product_type = null,$exceptId = null){
		if($product_type && $exceptId){
			$data = self::find()->where('product_type = :product_type and category_id != :category_id and published = 1 and deleted = 0', ['product_type'=>(int)$product_type, 'category_id'=>$exceptId])->all();
		}elseif($product_type){
			$data = self::find()->where('product_type = :product_type and published = 1 and deleted = 0', ['product_type'=>(int)$product_type])->all();
		}else{
			$data = self::findAll(['published'=>1,'deleted'=>0]);
		}
		return self::buildList($data);
	}
	public static function buildList( $ar, $pid = null,$separator='-- ' ) {
		
		$op = array();
		foreach( $ar as $item ) {
			if( $item->parent_id == $pid ) {
				if($pid){
					$item->title = $separator.$item->title;					
				}
				$op[] = $item;
				// using recursion
				$children =  self::buildList( $ar, $item->category_id ,$separator.$separator);
				if( $children ) {
					$op = array_merge($op,$children);
				}
			}
		}
		return $op;
	}

	public function getParentName(){
		if($this->parent_id){
			$parent = $this->findOne(['category_id'=>(int)$this->parent_id]);
			if($parent)
				return $parent->title;
		}
		return;
	}
	
	public static function getSelectedCate($categoryId) {
		$model = self::findOne(['category_id' => $categoryId,'published'=>1,'deleted'=>0]);
		return $model?[$model->category_id=>$model->title]:[];
	}
	
	public static function getCateList($productType,$cateId=null) {
		$model = self::getList($productType);
		
//		$model = self::findAll(\yii\helpers\ArrayHelper::merge($location, ['published'=>1,'deleted'=>0]));

		$out = ['output'=>[],'selected'=>''];
		if($model){
			$list = \yii\helpers\ArrayHelper::map($model,'category_id','title');	
			foreach ($list as $id => $title) {
				$tmp['id'] = $id;
				$tmp['name'] = $title;
				$out['output'][] = $tmp;
			}
			if($cateId)
				$out['selected'] = $cateId;
		}
		return $out;
	}
	
	public static function find()
    {
        $q = new \omgdef\multilingual\MultilingualQuery(get_called_class());
        return $q;
    }
}
