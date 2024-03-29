<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $session_id
 * @property int $course_p_id
 * @property string $session_duration
 * @property string $session_start_date
 * @property string $session_end_date
 * @property string $intake 
 * @property string $status
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
 * @property StdEnrollment[] $stdEnrollments
 * @property TeacherClassEnrollment[] $teacherClassEnrollments
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_p_id', 'session_duration', 'session_start_date', 'session_end_date', 'intake', 'status'], 'required'],
            [['session_start_date', 'session_end_date', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'safe'],
            [['intake','status'], 'string'],
            [['course_p_id', 'created_by', 'updated_by'], 'integer'],
            [['session_duration'], 'string', 'max' => 20],
            [['course_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseProgram::className(), 'targetAttribute' => ['course_p_id' => 'cp_id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'session_id' => 'Session ID',
            'course_p_id' => 'Course Program',
            'session_duration' => 'Session Duration',
            'session_start_date' => 'Session Start Date',
            'session_end_date' => 'Session End Date',
            'intake' => 'Intake',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[StdEnrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStdEnrollments()
    {
        return $this->hasMany(StdEnrollment::className(), ['session_id' => 'session_id']);
    }

    /**
     * Gets query for [[TeacherClassEnrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherClassEnrollments()
    {
        return $this->hasMany(TeacherClassEnrollment::className(), ['session_id' => 'session_id']);
    }
      /** 
    * Gets query for [[Announcements]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAnnouncements() 
   { 
       return $this->hasMany(Announcement::className(), ['session_id' => 'session_id']); 
   } 
 
   /** 
    * Gets query for [[AssignmentUploads]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAssignmentUploads() 
   { 
       return $this->hasMany(AssignmentUpload::className(), ['session_id' => 'session_id']); 
   } 
 
   /** 
    * Gets query for [[Inboxes]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getInboxes() 
   { 
       return $this->hasMany(Inbox::className(), ['session_id' => 'session_id']); 
   } 
 
   /** 
    * Gets query for [[Quizzs]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getQuizzs() 
   { 
       return $this->hasMany(Quizz::className(), ['session_id' => 'session_id']); 
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
    * Gets query for [[ClassHandouts]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getClassHandouts() 
   { 
       return $this->hasMany(ClassHandouts::className(), ['session_id' => 'session_id']); 
   } 
}
