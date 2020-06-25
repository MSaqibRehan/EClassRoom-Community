<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $teacher_id
 * @property int $user_id
 * @property string $teacher_name
 * @property string $teacher_father
 * @property string $teacher_mobile_no
 * @property string $teacher_gender
 * @property string $teacher_dob
 * @property string $teacher_address
 * @property string $status
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property User $user
 * @property TeacherClassEnrollment[] $teacherClassEnrollments
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'teacher_father', 'teacher_mobile_no', 'teacher_gender', 'teacher_dob', 'teacher_address', 'status' ,'teacher_cnic', 'teacher_name'], 'safe'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['teacher_gender', 'teacher_address', 'status'], 'string'],
            [['teacher_dob', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
            [['teacher_name', 'teacher_father'], 'string', 'max' => 255],
            [['teacher_mobile_no'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Teacher ID',
            'user_id' => 'User ID',
            'teacher_name' => 'Teacher Name',
            'teacher_father' => 'Teacher Father',
            'teacher_cnic' => 'Teacher cnic',
            'teacher_mobile_no' => 'Teacher Mobile No',
            'teacher_gender' => 'Teacher Gender',
            'teacher_dob' => 'Teacher Dob',
            'teacher_address' => 'Teacher Address',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[TeacherClassEnrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherClassEnrollments()
    {
        return $this->hasMany(TeacherClassEnrollment::className(), ['teacher_id' => 'teacher_id']);
    }
}
