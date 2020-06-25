<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "semester_subjects".
 *
 * @property int $sem_subj_id
 * @property int $course_p_id
 * @property int $semester_id
 * @property int $subject_no
 * @property string $subject_title
 * @property string $subject_description
 * @property string $subject__code
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Announcement[] $announcements
 * @property AssignmentUpload[] $assignmentUploads
 * @property Quizz[] $quizzs
 * @property CourseProgram $courseP
 * @property Semester $semester
 * @property TeacherClassEnrollment[] $teacherClassEnrollments
 */
class SemesterSubjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester_subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'semester_id', 'subject_no', 'subject_title', 'subject_description', 'subject__code'], 'required'],
            [['course_p_id', 'semester_id', 'subject_no', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['subject_title'], 'string', 'max' => 100],
            [['subject_description'], 'string', 'max' => 255],
            [['subject__code'], 'string', 'max' => 25],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sem_subj_id' => 'Sem Subj ID',
            'course_p_id' => 'Course P ID',
            'semester_id' => 'Semester ID',
            'subject_no' => 'Subject No',
            'subject_title' => 'Subject Title',
            'subject_description' => 'Subject Description',
            'subject__code' => 'Subject Code',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Announcements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncements()
    {
        return $this->hasMany(Announcement::className(), ['sem_sub_id' => 'sem_subj_id']);
    }

    /**
     * Gets query for [[AssignmentUploads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignmentUploads()
    {
        return $this->hasMany(AssignmentUpload::className(), ['sem_sub_id' => 'sem_subj_id']);
    }

    /**
     * Gets query for [[Quizzs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzs()
    {
        return $this->hasMany(Quizz::className(), ['sem_sub_id' => 'sem_subj_id']);
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
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[TeacherClassEnrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherClassEnrollments()
    {
        return $this->hasMany(TeacherClassEnrollment::className(), ['sem_sub_id' => 'sem_subj_id']);
    }
}
