<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property int $announce_id
 * @property int $course_p_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $sem_sub_id
 * @property int $teacher_id
 * @property string $announcement
 * @property string $status
 * @property string $created_at
 *
 * @property CourseProgram $courseP
 * @property Session $session
 * @property Semester $semester
 * @property SemesterSubjects $semSub
 * @property Teacher $teacher
 */
class Announcement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'teacher_id', 'announcement', 'status'], 'required'],
            [['course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'teacher_id'], 'integer'],
            [['announcement', 'status'], 'string'],
            [['created_at'], 'safe'],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
            [['sem_sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterSubjects::className(), 'targetAttribute' => ['sem_sub_id' => 'sem_subj_id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'teacher_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'announce_id' => 'Announce ID',
            'course_p_id' => 'Course Program',
            'session_id' => 'Session Duration',
            'semester_id' => 'Semester No',
            'sem_sub_id' => 'Semester Subject',
            'teacher_id' => 'Teacher Name',
            'announcement' => 'Announcement',
            'status' => 'Status',
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

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['teacher_id' => 'teacher_id']);
    }
}
