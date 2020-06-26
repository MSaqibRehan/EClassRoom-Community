<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inbox".
 *
 * @property int $inbox_id
 * @property int $course_p_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $sender_name
 * @property string $message
 * @property string $created_at
 *
 * @property CourseProgram $courseP
 * @property Session $session
 * @property Semester $semester
 * @property User $senderName
 */
class Inbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'session_id', 'semester_id', 'sender_name', 'message', 'created_at'], 'required'],
            [['course_p_id', 'session_id', 'semester_id', 'sender_name'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
            [['sender_name'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_name' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inbox_id' => 'Inbox ID',
            'course_p_id' => 'Course Program',
            'session_id' => 'Session Duration',
            'semester_id' => 'Semester No',
            'sender_name' => 'Sender Name',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[CourseP]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseP()
    {
        return $this->hasOne(CourseProgram::className(), ['cp_id' => 'course_p_id']);
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
     * Gets query for [[SenderName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSenderName()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_name']);
    }
}
