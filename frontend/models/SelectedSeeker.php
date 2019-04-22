<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "selected_seeker".
 *
 * @property int $selected_seeker_id
 * @property int $search_id
 * @property int $seeker_id
 * @property int $provider_id
 * @property int $job_type_searched
 * @property int $provider_job_id
 *
 * @property string $status
 * @property string $selection_time
 * @property string $availability_time
 * @property string $deadline
 * @property string $address
 * @property string $job_description
 * @property string $message
 * @property string $confirmation_time
 * @property string seeker_response_time
 * @property int provider_notification
 * @property int seeker_notification
 *
 * @property Seeker $seeker
 * @property Search $search
 * @property Provider $provider
 */
class SelectedSeeker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selected_seeker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seeker_id', 'provider_id','job_type_searched', 'status'], 'required'],

            [['provider_job_id','selection_time', 'availability_time', 'deadline', 'confirmation_time'], 'safe'],
            [['status', 'address'], 'string', 'max' => 30],
            [['job_description', 'message'], 'string', 'max' => 100],
            [['seeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seeker::className(), 'targetAttribute' => ['seeker_id' => 'seeker_id']],
          //  [['search_id'], 'exist', 'skipOnError' => true, 'targetClass' => Search::className(), 'targetAttribute' => ['search_id' => 'search_id']],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'provider_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'selected_seeker_id' => Yii::t('app', 'Selected Seeker ID'),
            'search_id' => Yii::t('app', 'Search ID'),
            'seeker_id' => Yii::t('app', 'Seeker ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'job_type_searched' => Yii::t('app', 'Job Type Searched ID'),
            'status' => Yii::t('app', 'Status'),
            'selection_time' => Yii::t('app', 'Selection Time'),
            'availability_time' => Yii::t('app', 'Availability Time'),
            'deadline' => Yii::t('app', 'Deadline'),
            'address' => Yii::t('app', 'Address'),
            'job_description' => Yii::t('app', 'Job Description'),
            'message' => Yii::t('app', 'Message'),
            'confirmation_time' => Yii::t('app', 'Confirmation Time'),
        ];
    }

    public function selectedNumber($providerid){
        $number = SelectedSeeker::find()->where(['provider_id'=>$providerid,'status'=>'Selected'])->count();
        return $number;
    }

    public function confirmedNumber($providerid){
        $number = SelectedSeeker::find()->where(['provider_id'=>$providerid,'status'=>'Confirmed'])->count();
        return $number;
    }

    /**
     * @param $providerid
     * @param $seekerid
     * @return bool
     * check if selected
     */
    public function selected($providerid,$seekerid){
        $selected = false;
            $sel = SelectedSeeker::findOne(['seeker_id'=>$seekerid,'provider_id'=>$providerid]);

        if($sel!=null && $sel->status == 'Selected'){
            $selected = true;
        }

        return $selected;

    }

    /**
     * Get selected_seeker data
     */

    public function getSelected_seeker($providerid,$seekerid){
        $sel = SelectedSeeker::findOne(['seeker_id'=>$seekerid,'provider_id'=>$providerid]);
        return $sel;
    }

    /**
    * Selected candidates by job
     */

    public function selectedcandidatesbyjob($providerid,$seekerid,$provider_job_id){
        $selected = false;

        $sel = SelectedSeeker::findOne(['seeker_id'=>$seekerid,'provider_id'=>$providerid,'provider_job_id'=>$provider_job_id]);

        if($sel!=null && $sel->status == 'Selected'){
            $selected = true;
        }

        return $selected;

    }

    /**
     * Get number of candidates of one provider job
     */

    public function numberOfCandidatesByJob($provider_job_id){

    $selectedcandidates = SelectedSeeker::find()
    ->where(['provider_job_id'=>$provider_job_id])
    ->count();
        return $selectedcandidates;
    }
/**
 * Number of new jobs offered
 */
    public function number_of_new_jobs_offered($seeker_id){
        $number = SelectedSeeker::find()
            ->where(['seeker_id'=>$seeker_id,
                'status'=>'Confirmed'])
        ->count();
        return $number;
    }

    /**
     *
     * Number of all jobs offered
     */

    public function number_of_jobs_offered($seeker_id){
        $number = SelectedSeeker::find()
            ->where(['seeker_id'=>$seeker_id])
            ->andWhere(['<>','status','Selected'])
            ->count();
        return $number;
    }

    /**
     * Number of jobs a seeker is selected in
     */

    public function number_of_job_selections($seeker_id){
        $number = SelectedSeeker::find()
            ->where(['seeker_id'=>$seeker_id,
                'status'=>'Selected'])
            ->count();
        return $number;
    }

    /**
     *
     * Number of accepted seekers
     */

    public function numberOfAcceptedCandidates($provider_job_id){
        $number = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Accepted'])
            ->count();
        return $number;
    }

    /**
     *
     * list of accepted seekers
     *
     */

    public function acceptedCandidates($provider_job_id){
        $accepted = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Accepted'])
        ->all();

        return $accepted;
    }

    /**
     *
     * list of nofeedbackyet seekers
     *
     */

    public function nofeedbackyetCandidates($provider_job_id){
        $accepted = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Confirmed'])
            ->all();

        return $accepted;
    }

    /**
     *
     * list of denied seekers
     *
     */

    public function deniedCandidates($provider_job_id){
        $accepted = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Denied'])
            ->all();

        return $accepted;
    }


    /**
     *
     * Number of denied seekers
     */

    public function numberOfDeniedCandidates($provider_job_id){
        $number = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Denied'])
            ->count();
        return $number;
    }

    /**
     *
     * Number of Confirmed as number of selected seekers
     */

    public function numberOfNoFeedbackCandidates($provider_job_id){
        $number = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Confirmed'])
            ->count();
        return $number;
    }

    /**
     *
     * Seeker status in the selectedseeker table by provider job
     */

    public function seekerStatus($provider_job_id,$seeker_id){

        $status = SelectedSeeker::findOne(['provider_job_id'=>$provider_job_id,
            'seeker_id'=>$seeker_id])->status;

        return $status;

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
    public function getProviderJob()
    {
        return $this->hasOne(ProviderJob::className(), ['provider_job_id' => 'provider_job_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getSearch()
    {
        return $this->hasOne(Search::className(), ['search_id' => 'search_id']);
    }
    */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['provider_id' => 'provider_id']);
    }
}
