<?php
 
namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher_class_enrollment".
 *
 * @property int $tce_id
 * @property int $teacher_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $sem_sub_id
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Teacher $teacher
 * @property Semester $semester
 * @property Session $session
 * @property SemesterSubjects $semSub 
 */
class TeacherClassEnrollment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_class_enrollment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'session_id', 'semester_id','sem_sub_id'], 'required'],
            [['teacher_id', 'session_id', 'semester_id', 'sem_sub_id', 'created_by', 'updated_by'], 'integer'],
            [['updated_by', 'updated_at', 'created_by', 'created_at','teacher_id',], 'safe'],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'teacher_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'semester_id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'session_id']],
            [['sem_sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterSubjects::className(), 'targetAttribute' => ['sem_sub_id' => 'sem_subj_id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tce_id' => 'Tce ID',
            'teacher_id' => 'Teacher Name',
            'session_id' => 'Session Duration',
            'semester_id' => 'Semester No',
            'sem_sub_id' => 'Semester Subject',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
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
