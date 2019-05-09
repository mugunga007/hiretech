<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "seeker_notification".
 *
 * @property int $seeker_notification_id
 * @property int $seeker_id
 * @property string $message
 * @property string $status
 * @property string type
 *
 * @property Seeker $seeker
 */
class SeekerNotification extends \yii\db\ActiveRecord
{
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
            [[ 'seeker_id', 'message', 'status','type'], 'required'],
            [['seeker_notification_id', 'seeker_id'], 'integer'],
            [['message'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['seeker_notification_id'], 'unique'],
            [['seeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seeker::className(), 'targetAttribute' => ['seeker_id' => 'seeker_id']],
        ];
    }

    /**
     * Cheching if there are new notification
     */

    public function check_new_notifications($seeker_id){
        $seeker_notifications = SeekerNotification::find()
        ->where(['seeker_id'=>$seeker_id])
        ->andWhere(['status'=>'unread']);

        return $seeker_notifications;
    }

    /**
     * Array push for notifications from db to nav
     */

    public function array_notifications($seeker_id)
    {
        $seeker_notifications = SeekerNotification::find()
            ->where(['seeker_id'=>$seeker_id])
            ->andWhere(['status'=>'unread']);
        $items = [];
        foreach ($seeker_notifications as $n) {
            array_push($items, ['label' => 'u', 'url' => 'seeker/notifications']);
        }
        return $items;
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
