<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AssignmentRemarks;

/**
 * AssignmentRemarksSearch represents the model behind the search form about `common\models\AssignmentRemarks`.
 */
class AssignmentRemarksSearch extends AssignmentRemarks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assign_remark_id', 'assign_id', 'assign_sub_id'], 'integer'],
            [['obt_marks', 'remarks', 'created_at'], 'safe'],
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
        $query = AssignmentRemarks::find();

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
            'assign_remark_id' => $this->assign_remark_id,
            'assign_id' => $this->assign_id,
            'assign_sub_id' => $this->assign_sub_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'obt_marks', $this->obt_marks])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
