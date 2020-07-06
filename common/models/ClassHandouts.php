<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_handouts".
 *
 * @property int $handout_id
 * @property int $course_p_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $sem_sub_id
 * @property int $week
 * @property int $lecture
 * @property string $topic
 * @property string $file
 * @property string $description
 * @property int $created_by
 * @property string $created_at
 *
 * @property CourseProgram $courseP
 * @property Session $session
 * @property Semester $semester
 * @property SemesterSubjects $semSub
 */
class ClassHandouts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_handouts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'week', 'lecture', 'topic', 'file', 'description', 'created_by', 'created_at'], 'required'],
            [['course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'week', 'lecture', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['topic', 'file'], 'string', 'max' => 255],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
            [['sem_sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterSubjects::className(), 'targetAttribute' => ['sem_sub_id' => 'sem_subj_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'handout_id' => 'Handout ID',
            'course_p_id' => 'Course P ID',
            'session_id' => 'Session ID',
            'semester_id' => 'Semester ID',
            'sem_sub_id' => 'Sem Sub ID',
            'week' => 'Week',
            'lecture' => 'Lecture',
            'topic' => 'Topic',
            'file' => 'File',
            'description' => 'Description',
            'created_by' => 'Created By',
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
     * Gets query for [[SemSub]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemSub()
    {
        return $this->hasOne(SemesterSubjects::className(), ['sem_subj_id' => 'sem_sub_id']);
    }
}
