<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QuizzRemarks;

/**
 * QuizzRemarksSearch represents the model behind the search form about `common\models\QuizzRemarks`.
 */
class QuizzRemarksSearch extends QuizzRemarks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quizz_remark_id', 'quizz_id', 'std_id'], 'integer'],
            [['remarks', 'obt_marks', 'quizz_key', 'created_at'], 'safe'],
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
        $query = QuizzRemarks::find();

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
            'quizz_remark_id' => $this->quizz_remark_id,
            'quizz_id' => $this->quizz_id,
            'std_id' => $this->std_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'obt_marks', $this->obt_marks])
            ->andFilterWhere(['like', 'quizz_key', $this->quizz_key]);

        return $dataProvider;
    }
}
