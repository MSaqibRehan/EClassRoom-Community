<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_enrollment".
 *
 * @property int $std_enrol_id
 * @property int $std_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Student $std
 * @property Semester $semester
 * @property Session $session
 */
class StdEnrollment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_enrollment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['std_id', 'session_id', 'semester_id', 'created_by', 'created_at'], 'required'],
            [['std_id', 'session_id', 'semester_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['std_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['std_id' => 'std_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'session_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'std_enrol_id' => 'Std Enrol ID',
            'std_id' => 'Std ID',
            'session_id' => 'Session ID',
            'semester_id' => 'Semester ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
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

    /**
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['session_id' => 'session_id']);
    }
}
