<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SelectedSeeker;

/**
 * SelectedSeekerSearch represents the model behind the search form of `frontend\models\SelectedSeeker`.
 */
class SelectedSeekerSearch extends SelectedSeeker
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selected_seeker_id', 'search_id', 'seeker_id', 'provider_id'], 'integer'],
            [['status', 'selection_time', 'availability_time', 'deadline', 'address', 'job_description', 'message', 'confirmation_time'], 'safe'],
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
        $query = SelectedSeeker::find();

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
            'selected_seeker_id' => $this->selected_seeker_id,
            'search_id' => $this->search_id,
            'seeker_id' => $this->seeker_id,
            'provider_id' => $this->provider_id,
            'selection_time' => $this->selection_time,
            'availability_time' => $this->availability_time,
            'deadline' => $this->deadline,
            'confirmation_time' => $this->confirmation_time,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
