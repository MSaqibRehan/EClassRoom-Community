<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Teacher;

/**
 * TeacherSearch represents the model behind the search form about `common\models\Teacher`.
 */
class TeacherSearch extends Teacher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['teacher_name', 'teacher_father', 'teacher_mobile_no', 'teacher_gender', 'teacher_dob', 'teacher_address', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Teacher::find();

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
            'teacher_id' => $this->teacher_id,
            'user_id' => $this->user_id,
            'teacher_dob' => $this->teacher_dob,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'teacher_name', $this->teacher_name])
            ->andFilterWhere(['like', 'teacher_father', $this->teacher_father])
            ->andFilterWhere(['like', 'teacher_mobile_no', $this->teacher_mobile_no])
            ->andFilterWhere(['like', 'teacher_gender', $this->teacher_gender])
            ->andFilterWhere(['like', 'teacher_address', $this->teacher_address])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
