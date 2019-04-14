<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Seeker;

/**
 * SeekerSearch represents the model behind the search form of `frontend\models\Seeker`.
 */
class SeekerSearch extends Seeker
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seeker_id', 'phone', 'job_type_id', 'views'], 'integer'],
            [['firstname', 'lastname', 'picture', 'email', 'password', 'dob', 'gender', 'address', 'experience', 'time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Seeker::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'seeker_id' => $this->seeker_id,
            'dob' => $this->dob,
            'phone' => $this->phone,
            'job_type_id' => $this->job_type_id,
            'views' => $this->views,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'experience', $this->experience]);

        return $dataProvider;
    }
}
