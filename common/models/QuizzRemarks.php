<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quizz_remarks".
 *
 * @property int $quizz_remark_id
 * @property int $quizz_id
 * @property int $std_id
 * @property string $remarks
 * @property string $obt_marks
 * @property string $quizz_key
 * @property string $created_at
 *
 * @property Quizz $quizz
 * @property Student $std
 */
class QuizzRemarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quizz_remarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quizz_id', 'std_id', 'remarks', 'obt_marks', 'quizz_key', 'created_at'], 'required'],
            [['quizz_id', 'std_id'], 'integer'],
            [['remarks'], 'string'],
            [['created_at'], 'safe'],
            [['obt_marks'], 'string', 'max' => 20],
            [['quizz_key'], 'string', 'max' => 255],
            [['quizz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quizz::className(), 'targetAttribute' => ['quizz_id' => 'quizz_id']],
            [['std_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['std_id' => 'std_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quizz_remark_id' => 'Quizz Remark ID',
            'quizz_id' => 'Quizz ID',
            'std_id' => 'Std ID',
            'remarks' => 'Remarks',
            'obt_marks' => 'Obt Marks',
            'quizz_key' => 'Quizz Key',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Quizz]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuizz()
    {
        return $this->hasOne(Quizz::className(), ['quizz_id' => 'quizz_id']);
    }

    /**
     * Gets query for [[Std]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStd()
    {
        return $this->hasOne(Student::className(), ['std_id' => 'std_id']);
    }
}
