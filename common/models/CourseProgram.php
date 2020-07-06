<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_program".
 *
 * @property int $cp_id
 * @property string $cp_name
 * @property int $no_of_semesters
 * @property string $status
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Announcement[] $announcements
 * @property Inbox[] $inboxes
 * @property Quizz[] $quizzs
 * @property Semester[] $semesters
 * @property SemesterSubjects[] $semesterSubjects
 */
class CourseProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cp_name', 'no_of_semesters', 'status'], 'required'],
            [['no_of_semesters', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['cp_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cp_id' => 'Cp ID',
            'cp_name' => 'Course Program Name',
            'no_of_semesters' => 'No Of Semesters',
            'status' => 'Status',
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
        return $this->hasMany(Announcement::className(), ['course_p_id' => 'cp_id']);
    }

    /**
     * Gets query for [[Inboxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInboxes()
    {
        return $this->hasMany(Inbox::className(), ['course_p_id' => 'cp_id']);
    }

    /**
     * Gets query for [[Quizzs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzs()
    {
        return $this->hasMany(Quizz::className(), ['course_p_id' => 'cp_id']);
    }

    /**
     * Gets query for [[Semesters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesters()
    {
        return $this->hasMany(Semester::className(), ['course_p_id' => 'cp_id']);
    }

    /**
     * Gets query for [[SemesterSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterSubjects()
    {
        return $this->hasMany(SemesterSubjects::className(), ['course_p_id' => 'cp_id']);
    }

    /** 
    * Gets query for [[ClassHandouts]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getClassHandouts() 
   { 
       return $this->hasMany(ClassHandouts::className(), ['course_p_id' => 'cp_id']); 
   }

   /** 
    * Gets query for [[Sessions]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getSessions() 
   { 
       return $this->hasMany(Session::className(), ['course_p_id' => 'cp_id']); 
   } 
}
