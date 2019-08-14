<?php

namespace frontend\models;

use Yii;
use yii\data\Sort;
use DateTime;

/**
 * This is the model class for table "provider_job".
 *
 * @property int $provider_job_id
 * @property int $provider_id
 * @property string $job_title
 * @property int $job_type_id
 * @property string $location
 * @property string $description
 * @property double $salary
 * @property int $work_hours
 * @property string $status
 *
 * @property string $contract_type
 * @property string date
 * @property string last_edit
 * @property int round
 *
 * This property has 3 stages with the corresponding id (1,2,3)
 * 1. No candidates selected
 * 2. Candidates confirmation pending
 * 3. Candidates contacted
 *
 *
 * @property JobType $jobType
 * @property Provider $provider
 */
class ProviderJob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provider_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'job_title','job_type_id'], 'required'],
            [[ 'job_title', 'location', 'description', 'salary', 'work_hours', 'contract_type','round'], 'safe'],
            [['provider_job_id', 'provider_id', 'job_type_id', 'work_hours'], 'integer'],
            [['salary'], 'number'],
            [['job_title'], 'unique','targetClass'=>'\frontend\models\ProviderJob', 'message' => 'You already have an offer with this title!'],
            [['location'], 'string', 'max' => 80],
            [['description'], 'string', 'max' => 250],
            [['contract_type'], 'string', 'max' => 40],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::className(), 'targetAttribute' => ['job_type_id' => 'job_type_id']],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'provider_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provider_job_id' => Yii::t('app', 'Provider Job ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'job_title' => Yii::t('app', 'Offer Title'),
            'job_type_id' => Yii::t('app', 'Job Type'),
            'location' => Yii::t('app', 'Location'),
            'description' => Yii::t('app', 'Description'),
            'salary' => Yii::t('app', 'Monthly Salary'),
            'work_hours' => Yii::t('app', 'Work Hours/Week'),
            'contract_type' => Yii::t('app', 'Contract Type'),

        ];
    }

    /**
     *
     * Get ProviderJob model
     */

    public function getProviderJob($provider_job_id){
        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        return $provider_job;
    }


    /**
     * sorting providerjoib
     */

    public function sort_provider_jobs(){
        $sortjobs = new Sort([
            'attributes'=>[
           'provider_job_id'=>SORT_ASC
            ]
        ]);
        return $sortjobs;
    }

    /**
     *
     * Number of Provider Jobs
     */

    public function provider_jobs_number($provider_id){
        $number = ProviderJob::find()
            ->where(['provider_id'=>$provider_id])
            ->count();
        return $number;
    }

    /**
     * Check if provider has a given job
     */

    public function checkjobs($job_type_id){

        $provider_id  = Yii::$app->user->identity->provider->provider_id;
        $provider_job = ProviderJob::find()
            ->where(['provider_id'=>$provider_id])
            ->andWhere(['job_type_id'=>$job_type_id])
            ->andWhere(['<','status',3])
        ;


        return $provider_job;
    }

    /**
     * Determine reopenable offer
     */

    public function reopenable($provider_job_id){
        $reopen = false;
        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        if($provider_job->status == 3)
         $reopen = true;

        return $reopen;
    }

    /**
     * Calculating time ago
     */

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
       //$agos = date('Y-m-d H:m:s');

        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    /**
     *
     */

    function get_time_ago( $time )
    {
        $time_difference = time() - $time;

        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

    /**
     * Check how many Pending selection
     */

    public function confirm_selections(){
        $provider_id = Yii::$app->user->identity->provider->provider_id;
        $provider_job = ProviderJob::find()

          // -> distinct('provider_job.provider_job_id')
            ->join('join','selected_seeker','provider_job.provider_job_id = selected_seeker.provider_job_id')
            ->where(['<=','provider_job.status',3])
            ->andWhere(['selected_seeker.provider_id'=>$provider_id])
            ->andWhere(['selected_seeker.status'=>'Selected'])
            ->count();

        return $provider_job;
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
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['provider_id' => 'provider_id']);
    }
}
