<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Inbox;

/**
 * InboxSearch represents the model behind the search form about `common\models\Inbox`.
 */
class InboxSearch extends Inbox
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inbox_id', 'course_p_id', 'session_id', 'semester_id', 'sender_name'], 'integer'],
            [['message', 'created_at'], 'safe'],
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
        $query = Inbox::find();

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
            'inbox_id' => $this->inbox_id,
            //'course_p_id' => $this->course_p_id,
            //'session_id' => $this->session_id,
            //'semester_id' => $this->semester_id,
            'sender_name' => $this->sender_name,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
          ;

        return $dataProvider;
    }
}
