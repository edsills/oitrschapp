<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HpcAccounts;

/**
 * HpcAccountsSearch represents the model behind the search form about `app\models\HpcAccounts`.
 */
class HpcAccountsSearch extends HpcAccounts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'machine_name', 'status', 'pin', 'shell'], 'safe'],
            [['project_id', 'user_number', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = HpcAccounts::find();

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
            'project_id' => $this->project_id,
            'user_number' => $this->user_number,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'machine_name', $this->machine_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'pin', $this->pin])
            ->andFilterWhere(['like', 'shell', $this->shell]);

        return $dataProvider;
    }
}
