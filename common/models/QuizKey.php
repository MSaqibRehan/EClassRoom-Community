<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quiz_key".
 *
 * @property int $quiz_key_id
 * @property int $quiz_id
 * @property string $quiz_key
 *
 * @property Quizz $quiz
 */
class QuizKey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz_key';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'quiz_key'], 'required'],
            [['quiz_id'], 'integer'],
            [['quiz_key'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quizz::className(), 'targetAttribute' => ['quiz_id' => 'quizz_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quiz_key_id' => 'Quiz Key ID',
            'quiz_id' => 'Quiz ID',
            'quiz_key' => 'Quiz Key',
        ];
    }

    /**
     * Gets query for [[Quiz]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quizz::className(), ['quizz_id' => 'quiz_id']);
    }
}
