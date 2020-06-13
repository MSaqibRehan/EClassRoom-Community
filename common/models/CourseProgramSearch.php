<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CourseProgram;

/**
 * CourseProgramSearch represents the model behind the search form about `common\models\CourseProgram`.
 */
class CourseProgramSearch extends CourseProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cp_id', 'no_of_semesters', 'created_by', 'updated_by'], 'integer'],
            [['cp_name', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = CourseProgram::find();

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
            'cp_id' => $this->cp_id,
            'no_of_semesters' => $this->no_of_semesters,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'cp_name', $this->cp_name])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
