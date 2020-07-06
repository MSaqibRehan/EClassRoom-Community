<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quizz".
 *
 * @property int $quizz_id
 * @property int $course_p_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $sem_sub_id
 * @property int $uploaded_by
 * @property int $quizz_no
 * @property string $quizz_title
 * @property string $quizz_file
 * @property string|null $quizz_note
 * @property string $total_marks
 * @property string $status
 * @property string $created_at
 *
 * @property CourseProgram $courseP
 * @property Session $session
 * @property Semester $semester
 * @property SemesterSubjects $semSub
 * @property Teacher $uploadedBy
 * @property QuizzRemarks[] $quizzRemarks
 */
class Quizz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quizz';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'session_id', 'semester_id', 'sem_sub_id', 'uploaded_by', 'quizz_no', 'quizz_title', 'total_marks', 'status', 'created_at'], 'required'],
            [['course_p_id', 'session_id', 'semester_id', 'uploaded_by', 'quizz_no'], 'integer'],
            [['quizz_note', 'status' , 'sem_sub_id'], 'string'],
            [['created_at', 'quizz_file'], 'safe'],
            [['quizz_title', 'quizz_file'], 'string', 'max' => 255],
            [['total_marks'], 'string', 'max' => 20],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
            [['sem_sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterSubjects::className(), 'targetAttribute' => ['sem_sub_id' => 'sem_subj_id']],
            [['uploaded_by'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['uploaded_by' => 'teacher_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quizz_id' => 'Quizz',
            'course_p_id' => 'Course Program',
            'session_id' => 'Session ',
            'semester_id' => 'Semester ',
            'sem_sub_id' => 'Subject ',
            'uploaded_by' => 'Uploaded By',
            'quizz_no' => 'Quizz No',
            'quizz_title' => 'Quizz Title',
            'quizz_file' => 'Quizz File',
            'quizz_note' => 'Quizz Note',
            'total_marks' => 'Total Marks',
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
     * Gets query for [[UploadedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUploadedBy()
    {
        return $this->hasOne(Teacher::className(), ['teacher_id' => 'uploaded_by']);
    }

    /**
     * Gets query for [[QuizzRemarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzRemarks()
    {
        return $this->hasMany(QuizzRemarks::className(), ['quizz_id' => 'quizz_id']);
    }
}
