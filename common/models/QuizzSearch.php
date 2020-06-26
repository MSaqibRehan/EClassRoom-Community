<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Quizz;

/**
 * QuizzSearch represents the model behind the search form about `common\models\Quizz`.
 */
class QuizzSearch extends Quizz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quizz_id', 'course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'uploaded_by', 'quizz_no'], 'integer'],
            [['quizz_title', 'quizz_file', 'quizz_note', 'total_marks', 'status', 'created_at'], 'safe'],
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
        $query = Quizz::find();

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
            'quizz_id' => $this->quizz_id,
            'course_p_id' => $this->course_p_id,
            'session_id' => $this->session_id,
            'semester_id' => $this->semester_id,
            'sem_sub_id' => $this->sem_sub_id,
            'uploaded_by' => $this->uploaded_by,
            'quizz_no' => $this->quizz_no,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'quizz_title', $this->quizz_title])
            ->andFilterWhere(['like', 'quizz_file', $this->quizz_file])
            ->andFilterWhere(['like', 'quizz_note', $this->quizz_note])
            ->andFilterWhere(['like', 'total_marks', $this->total_marks])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
