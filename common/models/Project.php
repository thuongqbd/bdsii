<?php

namespace common\models;

use Yii;
use \yii\behaviors\SluggableBehavior;
use \yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $address
 * @property integer $phone
 * @property string $website
 * @property string $email
 * @property string $detail
 * @property integer $city
 * @property integer $district
 * @property integer $ward
 * @property integer $street
 * @property string $lng
 * @property string $lat
 * @property integer $project_owner
 * @property integer $published
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $updated_at
 */
class Project extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['phone', 'city', 'district', 'ward', 'street', 'project_owner', 'published', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['detail'], 'string'],
            [['title', 'slug', 'address', 'website'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['lng', 'lat'], 'string', 'max' => 20]
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
                'class'=>  \yii\behaviors\SluggableBehavior::className(),
                'attribute'=>'title',
                'immutable' => true
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
				'langForeignKey' => 'project_id',
				'tableName' => "{{%project_lang}}",
				'attributes' => [
					'title', 'detail','slug','address'
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'Project ID'),
            'title' => Yii::t('project', 'Title'),
            'slug' => Yii::t('common', 'Slug'),
            'address' => Yii::t('common', 'Address'),
            'phone' => Yii::t('common', 'Phone'),
            'website' => Yii::t('common', 'Website'),
            'email' => Yii::t('common', 'Email'),
            'detail' => Yii::t('project', 'Detail'),
            'city' => Yii::t('common', 'City'),
            'district' => Yii::t('common', 'District'),
            'ward' => Yii::t('common', 'Ward'),
            'street' => Yii::t('common', 'Street'),
            'lng' => Yii::t('common', 'Lng'),
            'lat' => Yii::t('common', 'Lat'),
            'project_owner' => Yii::t('project', 'Project Owner'),
            'published' => Yii::t('common', 'Published'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
	
	public static function getProjectList($location,$projectId=null) {

		$model = self::findAll(\yii\helpers\ArrayHelper::merge($location, ['published'=>1,'deleted'=>0]));

		$out = ['output'=>[],'selected'=>''];
		if($model){
			$list = \yii\helpers\ArrayHelper::map($model,'id','title');	
			foreach ($list as $id => $title) {
				$tmp['id'] = $id;
				$tmp['name'] = $title;
				$out['output'][] = $tmp;
			}
			if($projectId)
				$out['selected'] = $projectId;
		}
		return $out;
	}
	
	public static function getSelectedProject($projectId) {
		$model = self::findOne(['id' => $projectId,'published'=>1,'deleted'=>0]);
		return $model?[$model->id=>$model->title]:[];
	}
	
	public static function find()
    {
        $q = new \omgdef\multilingual\MultilingualQuery(get_called_class());
        return $q;
    }
}
