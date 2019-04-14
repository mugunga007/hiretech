<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Provider;

/**
 * ProviderSearch represents the model behind the search form of `frontend\models\Provider`.
 */
class ProviderSearch extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_id'], 'integer'],
            [['names', 'email', 'password', 'type', 'address', 'phone', 'time'], 'safe'],
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
        $query = Provider::find();

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
            'provider_id' => $this->provider_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'names', $this->names])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
