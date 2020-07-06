<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ClassHandouts;

/**
 * ClassHandoutstSearch represents the model behind the search form about `common\models\ClassHandouts`.
 */
class ClassHandoutstSearch extends ClassHandouts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['handout_id', 'course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'week', 'lecture', 'created_by'], 'integer'],
            [['topic', 'file', 'description', 'created_at'], 'safe'],
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
        $query = ClassHandouts::find();

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
            'handout_id' => $this->handout_id,
            'course_p_id' => $this->course_p_id,
            'session_id' => $this->session_id,
            'semester_id' => $this->semester_id,
            'sem_sub_id' => $this->sem_sub_id,
            'week' => $this->week,
            'lecture' => $this->lecture,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
