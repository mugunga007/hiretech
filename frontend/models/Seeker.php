<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "seeker".
 *
 * @property int $seeker_id
 * @property string $firstname
 * @property string $lastname
 * @property string $picture
 * @property string $email
 * @property string $password

 * @property string $dob
 * @property string $gender
 * @property int $phone
 * @property string $address
 * @property int $job_type_id
 * @property string $experience
 * @property int $views
 * @property string $time
 *

 *
 *
 * @property SeekerJobType[] $seekerJobTypes
 */
class Seeker extends \yii\db\ActiveRecord
{
    public $password_repeat;
    public $age;
    public $searchjobtype;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seeker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'password','password_repeat', 'dob', 'gender', 'phone', 'address'], 'required'],
            [[ 'time', 'picture','views','experience','job_type_id'], 'safe'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'passwords do not match'],
            [['phone', 'job_type_id', 'views'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 50],
            [[ 'email', 'password'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 8],

           // [['dob'],'date','format'=>'Y-m-d'],
            [['address'], 'string', 'max' => 30],
            [['experience'], 'string', 'max' => 250],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seeker_id' => Yii::t('app', 'Seeker ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'picture' => Yii::t('app', 'Upload Picture'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'dob' => Yii::t('app', 'Date of birth'),
            'gender' => Yii::t('app', 'Gender'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'job_type_id' => Yii::t('app', 'Job Type'),
            'experience' => Yii::t('app', 'Experience'),
            'views' => Yii::t('app', 'Views'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeekerJobTypes()
    {
        return $this->hasMany(SeekerJobType::className(), ['seeker_id' => 'seeker_id']);
    }

    public function age($sdob){


        $today = date('Y-d-m');

        $this->age = date_diff(date_create($sdob),date_create($today))->format('%Y');

        return $this->age;
    }

}
