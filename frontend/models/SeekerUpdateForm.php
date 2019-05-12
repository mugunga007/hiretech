<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/05
 * Time: 10:59
 */

namespace frontend\models;


use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;

class SeekerUpdateForm extends Seeker
{

    /**
     * This is the model class to update seeker.
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

    public function rules()
    {
        return [
            [['firstname', 'lastname',  'dob', 'gender', 'phone', 'address'], 'required'],
           // [['picture','seeker_id'], 'safe'],
           // [['picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['phone', 'job_type_id', 'views'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 50],

            [['gender'], 'string', 'max' => 8],

             [['dob'],'date','format'=>'Y-m-d'],
            [['address'], 'string', 'max' => 30],
            [['experience'], 'string', 'max' => 250],

        ];
    }
/*
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);

            return true;
        } else {
            return false;
        }
    }
*/


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),

          //  'picture'=>Yii::t('app','Edit Picture'),
            'dob' => Yii::t('app', 'Date of birth'),
            'gender' => Yii::t('app', 'Gender'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'job_type_id' => Yii::t('app', 'Job Type'),
            'experience' => Yii::t('app', 'Experience'),

        ];
    }

}
