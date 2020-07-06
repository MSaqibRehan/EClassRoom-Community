<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QuizKey;

/**
 * QuizKeySearch represents the model behind the search form about `common\models\QuizKey`.
 */
class QuizKeySearch extends QuizKey
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quiz_key_id', 'quiz_id'], 'integer'],
            [['quiz_key'], 'safe'],
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
        $query = QuizKey::find();

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
            'quiz_key_id' => $this->quiz_key_id,
            'quiz_id' => $this->quiz_id,
        ]);

        $query->andFilterWhere(['like', 'quiz_key', $this->quiz_key]);

        return $dataProvider;
    }
}
