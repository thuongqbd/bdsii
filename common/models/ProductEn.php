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
class ProductEn extends Product
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
		return 'product_en';
    }
}
