<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form about `common\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['std_id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['std_reg_no', 'std_name', 'std_father_name', 'std_gender','std_cnic', 'std_dob', 'std_address', 'std_mobile_no', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Student::find();

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
            'std_id' => $this->std_id,
            'user_id' => $this->user_id,
            'std_dob' => $this->std_dob,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'std_reg_no', $this->std_reg_no])
            ->andFilterWhere(['like', 'std_name', $this->std_name])
            ->andFilterWhere(['like', 'std_father_name', $this->std_father_name])
            ->andFilterWhere(['like', 'std_gender', $this->std_gender])
            ->andFilterWhere(['like', 'std_address', $this->std_address])
            ->andFilterWhere(['like', 'std_cnic', $this->std_cnic])
            ->andFilterWhere(['like', 'std_mobile_no', $this->std_mobile_no])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
