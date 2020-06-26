<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Announcement;

/**
 * AnnouncementSearch represents the model behind the search form about `common\models\Announcement`.
 */
class AnnouncementSearch extends Announcement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['announce_id', 'course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'teacher_id'], 'integer'],
            [['announcement', 'status', 'created_at'], 'safe'],
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
        $query = Announcement::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('teacher');
        $query->joinWith('semester');
        $query->joinWith('session');
        $query->joinWith('semSub');
        $query->joinWith('courseP');

        $query->andFilterWhere([
            'announce_id' => $this->announce_id,
            // 'course_p_id' => $this->course_p_id,
            // 'session_id' => $this->session_id,
            // 'semester_id' => $this->semester_id,
            // 'sem_sub_id' => $this->sem_sub_id,
            // 'teacher_id' => $this->teacher_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'announcement', $this->announcement])
            ->andFilterWhere(['like', 'courseP.cp_name', $this->status])
            ->andFilterWhere(['like', 'teacher.teacher_name', $this->teacher_id])
            ->andFilterWhere(['like', 'semester.semester_no', $this->semester_id])
            ->andFilterWhere(['like', 'session.session_duration', $this->session_id])
            ->andFilterWhere(['like', 'semSub.subject_title', $this->sem_sub_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
