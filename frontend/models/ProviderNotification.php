<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provider_notification".
 *
 * @property int $provider_notification_id
 * @property int $provider_id
 * @property string $message
 * @property string $status
 * @property string $type
 * @property string $from_email
 * @property string $time
 *
 * @property Provider $provider
 */
class ProviderNotification extends \yii\db\ActiveRecord
{

    public $accepted_message = 'Your Offer was Accepted';
    public $denied_message = 'Your Offer was Denied';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provider_notification';
    }

    /**
     * Cheching if there are new notification
     */

    public function check_new_notifications($provider_id){
        $provider_notifications = ProviderNotification::find()
            ->where(['provider_id'=>$provider_id])
            ->andWhere(['status'=>'unread'])
            ->orderBy([
                'time'=>SORT_DESC
            ]);
        return $provider_notifications;
    }

    /**
     * Action create notification
     */

    public function notify_provider($provider_id,$message,$type,$from_email){
        $provider_notification = new ProviderNotification();
       $provider_notification->provider_id = $provider_id;
        $provider_notification->message = $message;

        $provider_notification->type = $type;
        $provider_notification->from_email = $from_email;
        $provider_notification->save();
        return true;


    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_id', 'message', 'type', 'from_email'], 'required'],
            [['provider_notification_id', 'provider_id'], 'integer'],
            [['time','status'], 'safe'],
            [['message', 'type', 'from_email'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['provider_notification_id'], 'unique'],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'provider_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provider_notification_id' => Yii::t('app', 'Provider Notification ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'from_email' => Yii::t('app', 'From Email'),
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
}
