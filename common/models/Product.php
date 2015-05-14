<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
//use common\components\ActiveRecord;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "product".
 *
 * @property string $product_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $product_type
 * @property integer $product_cate
 * @property integer $city
 * @property integer $district
 * @property integer $ward
 * @property integer $street
 * @property integer $project_id
 * @property double $area
 * @property integer $price
 * @property integer $price_type
 * @property string $address
 * @property double $facade
 * @property double $entry_width
 * @property integer $direction
 * @property integer $balcony_direction
 * @property integer $floor_number
 * @property integer $room_number
 * @property integer $toilet_number
 * @property string $interior
 * @property string $ct_name
 * @property string $ct_address
 * @property integer $ct_phone
 * @property integer $ct_mobile
 * @property string $ct_email
 * @property integer $approved
 * @property integer $author_id
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $published
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $updated_at
 * @property array $attachments
 * @property string	$lat
 * @property string	$lng
 */
class Product extends ActiveRecord
{	
	/**
     * @var array
     */
    public $attachments;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
		return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'description', 'product_type', 'product_cate', 'city', 'district', 'address', 'ct_mobile', 'start_date', 'end_date'], 'required', 'except'=>'frontendSearch'],
            [['description', 'interior'], 'string'],
            [['product_type', 'product_cate', 'city', 'district', 'ward', 'street', 'project_id', 'price', 'price_type', 'direction', 'balcony_direction', 'floor_number', 'room_number', 'toilet_number', 'ct_phone', 'ct_mobile', 'approved', 'author_id','published', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['area', 'facade', 'entry_width'], 'number'],
            [['title', 'slug', 'address', 'ct_address', 'ct_email'], 'string', 'max' => 255],
            [['ct_name'], 'string', 'max' => 50],
			[['start_date'], 'default', 'value'=>time()],
			[['end_date'], 'default', 'value'=>time()+ (90 * 24 * 60 * 60)],
            [['start_date','end_date'], 'filter', 'filter'=>'strtotime'],
			[['attachments','lat','lng'], 'safe']
        ];
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
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'productAttachments'
            ],

        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttachments()
    {
        return $this->hasMany(ProductAttachment::className(), ['product_id' => 'product_id']);
    }
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('product', 'Product ID'),
            'title' => Yii::t('product', 'Title'),
            'slug' => Yii::t('product', 'Slug'),
            'description' => Yii::t('product', 'Description'),
            'product_type' => Yii::t('product', 'Product Type'),
            'product_cate' => Yii::t('product', 'Product Cate'),
            'city' => Yii::t('common', 'City'),
            'district' => Yii::t('common', 'District'),
            'ward' => Yii::t('common', 'Ward'),
            'street' => Yii::t('common', 'Street'),
            'project_id' => Yii::t('product', 'Project'),
            'area' => Yii::t('product', 'Area'),
            'price' => Yii::t('product', 'Price'),
            'price_type' => Yii::t('product', 'Price Type'),
            'address' => Yii::t('product', 'Address'),
            'facade' => Yii::t('product', 'Facade'),
            'entry_width' => Yii::t('product', 'Entry Width'),
            'direction' => Yii::t('product', 'Direction'),
            'balcony_direction' => Yii::t('product', 'Balcony Direction'),
            'floor_number' => Yii::t('product', 'Floor Number'),
            'room_number' => Yii::t('product', 'Room Number'),
            'toilet_number' => Yii::t('product', 'Toilet Number'),
            'interior' => Yii::t('product', 'Interior'),
            'ct_name' => Yii::t('product', 'Ct Name'),
            'ct_address' => Yii::t('product', 'Ct Address'),
            'ct_phone' => Yii::t('product', 'Ct Phone'),
            'ct_mobile' => Yii::t('product', 'Ct Mobile'),
            'ct_email' => Yii::t('product', 'Ct Email'),
            'approved' => Yii::t('common', 'Approved'),
            'author_id' => Yii::t('product', 'Author ID'),
            'start_date' => Yii::t('product', 'Start Date'),
            'end_date' => Yii::t('product', 'End Date'),
			'published' => Yii::t('common', 'Published'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectForProduct()
    {	
		$project = $this->hasOne(Project::className(), ['id' => 'project_id'])->one();
        return $project?$project:null;
    }
}
