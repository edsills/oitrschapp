<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HpcProjects;

/**
 * HpcProjectsSearch represents the model behind the search form about `app\models\HpcProjects`.
 */
class HpcProjectsSearch extends HpcProjects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'user_number', 'program_id'], 'integer'],
            [['project_type', 'group_name'], 'safe'],
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
        $query = HpcProjects::find();

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
            'program_id' => $this->program_id,
        ]);

        $query->andFilterWhere(['like', 'project_type', $this->project_type])
            ->andFilterWhere(['like', 'group_name', $this->group_name]);

        return $dataProvider;
    }
}
