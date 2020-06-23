<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $semester_id
 * @property int $course_p_id
 * @property string $semester_no
 * @property string $class_time
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Announcement[] $announcements
 * @property AssignmentUpload[] $assignmentUploads
 * @property Inbox[] $inboxes
 * @property Quizz[] $quizzs
 * @property CourseProgram $courseP
 * @property SemesterSubjects[] $semesterSubjects
 * @property StdEnrollment[] $stdEnrollments
 * @property TeacherClassEnrollment[] $teacherClassEnrollments
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'semester_no', 'class_time'], 'required'],
            [['course_p_id', 'created_by', 'updated_by'], 'integer'],
            [['class_time'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['semester_no'], 'string', 'max' => 50],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'semester_id' => 'Semester ID',
            'course_p_id' => 'Course Program Name',
            'semester_no' => 'Semester No',
            'class_time' => 'Class Time',
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
        return $this->hasMany(Announcement::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[AssignmentUploads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignmentUploads()
    {
        return $this->hasMany(AssignmentUpload::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[Inboxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInboxes()
    {
        return $this->hasMany(Inbox::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[Quizzs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzs()
    {
        return $this->hasMany(Quizz::className(), ['semester_id' => 'semester_id']);
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
     * Gets query for [[SemesterSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterSubjects()
    {
        return $this->hasMany(SemesterSubjects::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[StdEnrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStdEnrollments()
    {
        return $this->hasMany(StdEnrollment::className(), ['semester_id' => 'semester_id']);
    }

    /**
     * Gets query for [[TeacherClassEnrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherClassEnrollments()
    {
        return $this->hasMany(TeacherClassEnrollment::className(), ['semester_id' => 'semester_id']);
    }
}
