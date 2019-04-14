<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "search".
 *
 * @property int $search_id
 * @property int $provider_id
 * @property int $job_type_id
 * @property string $address
 * @property int $age_min
 * @property int $age_max
 * @property int $gender
 * @property string $time
 *
 * @property Provider $provider
 * @property JobType $jobType
 * @property SelectedSeeker[] $selectedSeekers
 */
class Search extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'search';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_id', 'job_type_id', 'address'], 'required'],
            [['age_min', 'age_max', 'gender'], 'safe'],

            [['provider_id', 'job_type_id', 'age_min', 'age_max', 'gender'], 'integer'],
            [['time'], 'safe'],
            [['address'], 'string', 'max' => 80],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'provider_id']],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::className(), 'targetAttribute' => ['job_type_id' => 'job_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'search_id' => Yii::t('app', 'Search ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'job_type_id' => Yii::t('app', 'Job Type ID'),
            'address' => Yii::t('app', 'Address'),
            'age_min' => Yii::t('app', 'Age Min'),
            'age_max' => Yii::t('app', 'Age Max'),
            'gender' => Yii::t('app', 'Gender'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['provider_id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobType()
    {
        return $this->hasOne(JobType::className(), ['job_type_id' => 'job_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getSelectedSeekers()
    {
        return $this->hasMany(SelectedSeeker::className(), ['search_id' => 'search_id']);
    }
    */
}
