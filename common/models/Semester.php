<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $semester_id
 * @property int $course_p_id
 * @property string $semester_no
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property CourseProgram $courseP
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
            [['course_p_id', 'semester_no', 'created_by', 'created_at'], 'required'],
            [['course_p_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'course_p_id' => 'Course P ID',
            'semester_no' => 'Semester No',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
