<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AssignmentUpload;

/**
 * AssignmentUploadSearch represents the model behind the search form about `common\models\AssignmentUpload`.
 */
class AssignmentUploadSearch extends AssignmentUpload
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assign_id', 'session_id', 'semester_id', 'sem_sub_id', 'uploaded_by', 'assign_no'], 'integer'],
            [['assign_title', 'assign_file', 'assign_note', 'due_date', 'total_marks', 'status', 'created_at'], 'safe'],
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
        $query = AssignmentUpload::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('semester');
        $query->joinWith('session');
        $query->joinWith('semSub');
        $query->joinWith('uploadedBy');

        $query->andFilterWhere([
            'assign_id' => $this->assign_id,
            // 'session_id' => $this->session_id,
            // 'semester_id' => $this->semester_id,
            // 'sem_sub_id' => $this->sem_sub_id,
            // 'uploaded_by' => $this->uploaded_by,
            'assign_no' => $this->assign_no,
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'assign_title', $this->assign_title])
            ->andFilterWhere(['like', 'semester.semester_no', $this->semester_id])
            ->andFilterWhere(['like', 'session.session_duration', $this->session_id])
            ->andFilterWhere(['like', 'semSub.subject_title', $this->sem_sub_id])
            ->andFilterWhere(['like', 'uploadedBy.teacher_name', $this->uploaded_by])
            ->andFilterWhere(['like', 'assign_file', $this->assign_file])
            ->andFilterWhere(['like', 'assign_note', $this->assign_note])
            ->andFilterWhere(['like', 'total_marks', $this->total_marks])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
