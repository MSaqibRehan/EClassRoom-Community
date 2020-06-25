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
            [['sem_subj_id', 'course_p_id', 'semester_id', 'subject_no', 'created_by', 'updated_by'], 'integer'],
            [['subject_title', 'subject_description', 'subject__code', 'created_at', 'updated_at'], 'safe'],
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
            'course_p_id' => $this->course_p_id,
            'semester_id' => $this->semester_id,
            'subject_no' => $this->subject_no,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'subject_title', $this->subject_title])
            ->andFilterWhere(['like', 'subject_description', $this->subject_description])
            ->andFilterWhere(['like', 'subject__code', $this->subject__code]);

        return $dataProvider;
    }
}
