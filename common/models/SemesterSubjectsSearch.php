<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SemesterSubjects;

/**
 * SemesterSubjectsSearch represents the model behind the search form about `common\models\SemesterSubjects`.
 */
class SemesterSubjectsSearch extends SemesterSubjects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sem_subj_id', 'created_by', 'updated_by'], 'integer'],
            [['subj_1_title', 'subj_1_description', 'subj_2_title', 'subj_2_description', 'subj_3_title', 'subj_3_description', 'subj_4_title', 'subj_4_description', 'subj_5_title', 'subj_5_description', 'subj_6_title', 'subj_6_description', 'created_at', 'updated_at'], 'safe'],
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
        $query = SemesterSubjects::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sem_subj_id' => $this->sem_subj_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'subj_1_title', $this->subj_1_title])
            ->andFilterWhere(['like', 'subj_1_description', $this->subj_1_description])
            ->andFilterWhere(['like', 'subj_2_title', $this->subj_2_title])
            ->andFilterWhere(['like', 'subj_2_description', $this->subj_2_description])
            ->andFilterWhere(['like', 'subj_3_title', $this->subj_3_title])
            ->andFilterWhere(['like', 'subj_3_description', $this->subj_3_description])
            ->andFilterWhere(['like', 'subj_4_title', $this->subj_4_title])
            ->andFilterWhere(['like', 'subj_4_description', $this->subj_4_description])
            ->andFilterWhere(['like', 'subj_5_title', $this->subj_5_title])
            ->andFilterWhere(['like', 'subj_5_description', $this->subj_5_description])
            ->andFilterWhere(['like', 'subj_6_title', $this->subj_6_title])
            ->andFilterWhere(['like', 'subj_6_description', $this->subj_6_description]);

        return $dataProvider;
    }
}
