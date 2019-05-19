<?php

namespace frontend\models;

use Yii;
use frontend\models\Provider;

/**
 * This is the model class for table "seeker_notification".
 *
 * @property int $seeker_notification_id
 * @property int $seeker_id
 * @property string $message
 * @property string $status
 * @property string type
 * @property string from_email
 *
 * @property Seeker $seeker
 */
class SeekerNotification extends \yii\db\ActiveRecord
{
    public $bookmark_message = 'Your Profile Got Saved By an Employer, Good Luck!';
    public $confirmed_message = 'Congratulations! A New Offer was sent to you! we wish you Good Luck';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seeker_notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'seeker_id', 'message', 'type'], 'required'],
            [['seeker_notification_id', 'seeker_id'], 'integer'],
            [['message'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 100],

           // [['seeker_notification_id'], 'unique'],
            [['seeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seeker::className(), 'targetAttribute' => ['seeker_id' => 'seeker_id']],
        ];
    }

    /**
     * Cheching if there are new notification
     */

    public function check_new_notifications($seeker_id){
        $seeker_notifications = SeekerNotification::find()
        ->where(['seeker_id'=>$seeker_id])
        ->andWhere(['status'=>'unread'])
        ->orderBy([
            'time'=>SORT_DESC
        ]);
        return $seeker_notifications;
    }

    /**
     * Array push for notifications from db to nav
     */

    public function array_notifications($seeker_id)
    {
        $seeker_notifications = SeekerNotification::find()
            ->where(['seeker_id'=>$seeker_id])
            ->andWhere(['status'=>'unread'])
            ->orderBy([
                'time'=>SORT_DESC
            ]);
        $items = [];
        foreach ($seeker_notifications as $n) {
            array_push($items, ['label' => 'u', 'url' => 'seeker/notifications']);
        }
        return $items;
    }

    /**
     * Action create notification
     */

    public function notify_seeker($seeker_id,$message,$type,$from_email){
        $seeker_notification = new SeekerNotification();
        $seeker_notification->seeker_id = $seeker_id;
        $seeker_notification->message = $message;

        $seeker_notification->type = $type;
        $seeker_notification->from_email = $from_email;
        $seeker_notification->save();
        return true;


    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seeker_notification_id' => Yii::t('app', 'Seeker Notification ID'),
            'seeker_id' => Yii::t('app', 'Seeker ID'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeeker()
    {
        return $this->hasOne(Seeker::className(), ['seeker_id' => 'seeker_id']);
    }


}
