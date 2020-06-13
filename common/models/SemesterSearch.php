<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Semester;

/**
 * SemesterSearch represents the model behind the search form about `common\models\Semester`.
 */
class SemesterSearch extends Semester
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['semester_id', 'course_p_id', 'created_by', 'updated_by'], 'integer'],
            [['semester_no', 'created_at', 'updated_at'], 'safe'],
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
        $query = Semester::find();

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
            'semester_id' => $this->semester_id,
            'course_p_id' => $this->course_p_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'semester_no', $this->semester_no]);

        return $dataProvider;
    }
}
