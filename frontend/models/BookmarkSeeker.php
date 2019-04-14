<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bookmark_seeker".
 *
 * @property int $bookmark_seeker_id
 * @property int $provider_id
 * @property int $seeker_id
 * @property int job_type_id
 * @property Provider $provider
 * @property Seeker $seeker
 */
class BookmarkSeeker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookmark_seeker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'provider_id', 'seeker_id','job_type_id'], 'required'],
            [['bookmark_seeker_id', 'provider_id', 'seeker_id'], 'integer'],
            [['provider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provider::className(), 'targetAttribute' => ['provider_id' => 'provider_id']],
            [['seeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seeker::className(), 'targetAttribute' => ['seeker_id' => 'seeker_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bookmark_seeker_id' => Yii::t('app', 'Bookmark Seeker ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'seeker_id' => Yii::t('app', 'Seeker ID'),
        ];
    }




    /**
     * Getting the number of bookmarks
     */

    public function number_of_bookmarked($provider_id){
        $number = BookmarkSeeker::find()
            ->where(['provider_id'=>$provider_id])

            ->count();
        return $number;
    }

    /**
     * Getting number of bookmarked_per_job_type
     */

    public function number_of_bookmarks_per_job_type($provider_id,$job_type_id){
        $number = BookmarkSeeker::find()
            ->where(['provider_id'=>$provider_id])
            ->andWhere(['job_type_id'=>$job_type_id])
            ->count();
        return $number;
    }

    /**
     *
     * Check if bookmarked
     */

    public function getBookmark($provider_id,$seeker_id){

        $bookmark_seeker = BookmarkSeeker::findOne([
            'provider_id'=>$provider_id,
            'seeker_id'=>$seeker_id
        ]);

        return $bookmark_seeker;

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
    public function getSeeker()
    {
        return $this->hasOne(Seeker::className(), ['seeker_id' => 'seeker_id']);
    }


}
