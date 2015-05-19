<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property string $fullname
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property integer $gender
 * @property string $yahoo
 * @property string $skype
 * @property string $avatar_path
 * @property string $mobile
 * @property string $intro
 * @property integer $province
 * @property integer $district
 * @property integer $ward
 * @property string $local_address
 * @property string $avatar_base_url
 * @property string $locale
 * @property integer $account_type
 * @property integer $dob
 * @property string $phone
 *	@property string $picture
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    public $picture;

    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required','except'=>'create'],
			[['fullname','mobile'], 'required'],
            [['gender', 'province', 'district', 'ward', 'account_type', 'dob'], 'integer'],
            [['intro'], 'string'],
            [['gender'], 'in', 'range'=>[self::GENDER_FEMALE, self::GENDER_MALE]],
            [['fullname', 'firstname', 'middlename', 'lastname', 'yahoo', 'skype', 'avatar_path', 'local_address', 'avatar_base_url'], 'string', 'max' => 255],
            [['mobile', 'phone'], 'string', 'max' => 12],
			['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            ['picture', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'Middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'locale' => Yii::t('common', 'Locale'),
            'picture' => Yii::t('common', 'Picture'),
            'gender' => Yii::t('common', 'Gender'),			
			'fullname' => Yii::t('common', 'Fullname'),
            'yahoo' => Yii::t('common', 'Yahoo'),
            'skype' => Yii::t('common', 'Skype'),
            'avatar_path' => Yii::t('common', 'Avatar Path'),
            'mobile' => Yii::t('common', 'Mobile'),
            'intro' => Yii::t('common', 'Intro'),
            'province' => Yii::t('product', 'Province'),
            'district' => Yii::t('product', 'District'),
            'ward' => Yii::t('product', 'Ward'),
            'account_type' => Yii::t('common', 'Account Type'),
            'dob' => Yii::t('common', 'Dob'),
            'phone' => Yii::t('common', 'Phone'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->session->setFlash('forceUpdateLocale');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }

    public function getAvatar()
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : false;
    }
}
