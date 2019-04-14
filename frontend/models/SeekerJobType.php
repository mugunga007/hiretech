<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "seeker_job_type".
 *
 * @property int $id
 * @property int $seeker_id
 * @property int $job_type_id
 *
 * @property Seeker $seeker
 * @property JobType $jobType
 */
class SeekerJobType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seeker_job_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seeker_id', 'job_type_id'], 'required'],
            [['seeker_id', 'job_type_id'], 'integer'],
            [['seeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seeker::className(), 'targetAttribute' => ['seeker_id' => 'seeker_id']],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::className(), 'targetAttribute' => ['job_type_id' => 'job_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seeker_id' => Yii::t('app', 'Seeker '),
            'job_type_id' => Yii::t('app', 'Job Type '),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeeker()
    {
        return $this->hasOne(Seeker::className(), ['seeker_id' => 'seeker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobType()
    {
        return $this->hasOne(JobType::className(), ['job_type_id' => 'job_type_id']);
    }
}
