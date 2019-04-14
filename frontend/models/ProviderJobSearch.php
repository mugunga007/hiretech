<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ProviderJob;

/**
 * ProviderJobSearch represents the model behind the search form of `frontend\models\ProviderJob`.
 */
class ProviderJobSearch extends ProviderJob
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_job_id', 'provider_id', 'job_type_id', 'work_hours'], 'integer'],
            [['job_title', 'location', 'description', 'contract_type'], 'safe'],
            [['salary'], 'number'],
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
    $query = ProviderJob::find();

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
        'provider_job_id' => $this->provider_job_id,
        'provider_id' => $this->provider_id,
        'job_type_id' => $this->job_type_id,
        'salary' => $this->salary,
        'work_hours' => $this->work_hours,
    ]);

    $query->andFilterWhere(['like', 'job_title', $this->job_title])
        ->andFilterWhere(['like', 'location', $this->location])
        ->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['like', 'contract_type', $this->contract_type]);

    return $dataProvider;
}

    public function searchByProvider($params)
    {

        $query = ProviderJob::find()->where(['provider_id'=>\Yii::$app->user->identity->provider->provider_id]);

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
            'provider_job_id' => $this->provider_job_id,
            'provider_id' => $this->provider_id,
            'job_type_id' => $this->job_type_id,
            'salary' => $this->salary,
            'work_hours' => $this->work_hours,
        ]);


        $query->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'contract_type', $this->contract_type]);

        return $dataProvider;
    }

}
