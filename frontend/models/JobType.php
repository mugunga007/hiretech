<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_type".
 *
 * @property int $job_type_id
 * @property string $title
 * @property string $description
 *
 * @property Search[] $searches
 * @property SeekerJobType[] $seekerJobTypes
 */
class JobType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'job_type_id' => Yii::t('app', 'Job Type ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     *
     * Getting Jobtype model
     */

    public function getJobType($job_type_id){
        $jobtype = JobType::findOne(['job_type_id'=>$job_type_id]);
        return $jobtype;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearches()
    {
        return $this->hasMany(Search::className(), ['job_type_id' => 'job_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeekerJobTypes()
    {
        return $this->hasMany(SeekerJobType::className(), ['job_type_id' => 'job_type_id']);
    }
}
