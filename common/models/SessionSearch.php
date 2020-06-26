<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Session;

/**
 * SessionSearch represents the model behind the search form about `common\models\Session`.
 */
class SessionSearch extends Session
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'created_by', 'updated_by'], 'integer'],
            [['session_duration', 'session_start_date', 'session_end_date', 'intake', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Session::find();

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
            'session_id' => $this->session_id,
            'session_start_date' => $this->session_start_date,
            'session_end_date' => $this->session_end_date,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'session_duration', $this->session_duration])
              ->andFilterWhere(['like', 'intake', $this->intake])
              ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
