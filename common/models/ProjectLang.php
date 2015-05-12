<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_lang".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $language
 * @property string $title
 * @property string $slug
 * @property string $detail
 * @property string $address
 *
 * @property Project $project
 */
class ProjectLang extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'language', 'title', 'slug'], 'required'],
            [['project_id'], 'integer'],
            [['detail'], 'string'],
            [['language'], 'string', 'max' => 6],
            [['title', 'slug', 'address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'project_id' => Yii::t('project', 'Project ID'),
            'language' => Yii::t('project', 'Language'),
            'title' => Yii::t('project', 'Title'),
            'slug' => Yii::t('common', 'Slug'),
            'detail' => Yii::t('project', 'Detail'),
            'address' => Yii::t('common', 'Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
