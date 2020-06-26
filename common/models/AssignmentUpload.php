<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assignment_upload".
 *
 * @property int $assign_id
 * @property int $session_id
 * @property int $semester_id
 * @property int $sem_sub_id
 * @property int $uploaded_by
 * @property int $assign_no
 * @property string $assign_title
 * @property string $assign_file
 * @property string|null $assign_note
 * @property string $due_date
 * @property string $total_marks
 * @property string $status
 * @property string $created_at
 *
 * @property AssignmentRemarks[] $assignmentRemarks
 * @property AssignmentSubmit[] $assignmentSubmits
 * @property Session $session
 * @property Semester $semester
 * @property SemesterSubjects $semSub
 * @property Teacher $uploadedBy
 */
class AssignmentUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'semester_id', 'sem_sub_id', 'uploaded_by', 'assign_no', 'assign_title', 'assign_file', 'due_date', 'total_marks', 'status', 'created_at'], 'required'],
            [['session_id', 'semester_id', 'sem_sub_id', 'uploaded_by', 'assign_no'], 'integer'],
            [['assign_note', 'status'], 'string'],
            [['due_date', 'created_at'], 'safe'],
            [['assign_title'], 'string', 'max' => 200],
            [['assign_file'], 'string', 'max' => 255],
            [['total_marks'], 'string', 'max' => 20],
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
            'assign_id' => 'Assign ID',
            'session_id' => 'Session ID',
            'semester_id' => 'Semester ID',
            'sem_sub_id' => 'Sem Sub ID',
            'uploaded_by' => 'Uploaded By',
            'assign_no' => 'Assignment No',
            'assign_title' => 'Assign Title',
            'assign_file' => 'Assign File',
            'assign_note' => 'Assign Note',
            'due_date' => 'Due Date',
            'total_marks' => 'Total Marks',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[AssignmentRemarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignmentRemarks()
    {
        return $this->hasMany(AssignmentRemarks::className(), ['assign_id' => 'assign_id']);
    }

    /**
     * Gets query for [[AssignmentSubmits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignmentSubmits()
    {
        return $this->hasMany(AssignmentSubmit::className(), ['assign_id' => 'assign_id']);
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
}
