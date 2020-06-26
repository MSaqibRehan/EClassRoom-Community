<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AssignmentSubmit;

/**
 * AssignmentSubmitSearch represents the model behind the search form about `common\models\AssignmentSubmit`.
 */
class AssignmentSubmitSearch extends AssignmentSubmit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assign_sub_id', 'assign_id', 'std_id'], 'integer'],
            [['attach_file', 'submit_date', 'status'], 'safe'],
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
        $query = AssignmentSubmit::find();

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
            'assign_sub_id' => $this->assign_sub_id,
            'assign_id' => $this->assign_id,
            'std_id' => $this->std_id,
            'submit_date' => $this->submit_date,
        ]);

        $query->andFilterWhere(['like', 'attach_file', $this->attach_file])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
