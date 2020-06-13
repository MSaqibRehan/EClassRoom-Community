<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StdEnrollment;

/**
 * StdEnrollmentSearch represents the model behind the search form about `common\models\StdEnrollment`.
 */
class StdEnrollmentSearch extends StdEnrollment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['std_enrol_id', 'std_id', 'session_id', 'semester_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = StdEnrollment::find();

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
            'std_enrol_id' => $this->std_enrol_id,
            'std_id' => $this->std_id,
            'session_id' => $this->session_id,
            'semester_id' => $this->semester_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
