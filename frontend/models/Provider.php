<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider".
 *
 * @property int $provider_id
 * @property string $names
 * @property string $email
 * @property string $password
 * @property string $type
 * @property string $address
 * @property string $phone
 * @property string $time

 * @property Search[] $searches
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     *
     */
    public $password_repeat;
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['names', 'email', 'password','password_repeat', 'type', 'address', 'phone'], 'required'],
            [['time'], 'safe'],
            [['email'],'email'],
           // ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'passwords do not match'],
            [['names', 'email', 'password'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 25],
            [['address'], 'string', 'max' => 50],
            [['phone'],  'number'],
           // [['phone'],'match','pattern'=>'/^[0]\d{9}$/','message'=>'The valid phone format is: 07xxxxxxxx'],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provider_id' => Yii::t('app', 'Provider ID'),
            'names' => Yii::t('app', 'Names'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'type' => Yii::t('app', 'Type of Employer'),
            'address' => Yii::t('app', 'Location'),
            'phone' => Yii::t('app', 'Phone'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearches()
    {
        return $this->hasMany(Search::className(), ['provider_id' => 'provider_id']);
    }

    public function getProviderJobs(){
        return $this->hasMany(ProviderJob::className(),['provider_id'=>'provider_id']);
    }
}
