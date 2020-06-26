<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $std_id
 * @property int $user_id
 * @property string $std_reg_no
 * @property string $std_cnic
 * @property string $std_name
 * @property string $std_father_name
 * @property string $std_gender
 * @property string $std_dob
 * @property string $std_address
 * @property string $std_mobile_no
 * @property string $status
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property AssignmentSubmit[] $assignmentSubmits 
 * @property QuizzRemarks[] $quizzRemarks 
 * @property StdEnrollment[] $stdEnrollments
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }
   

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'std_reg_no', 'std_name', 'std_father_name', 'std_gender', 'std_dob', 'std_address', 'std_mobile_no', 'status', 'std_cnic' ], 'required'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['std_gender', 'std_address', 'status'], 'string'],
            [['std_dob', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'safe'],
            [['std_reg_no', 'std_name', 'std_father_name'], 'string', 'max' => 255],
            [['std_mobile_no','std_cnic'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'std_id' => 'Std ID',
            'user_id' => 'User ID',
            'std_reg_no' => 'Std Reg No',
            'std_name' => 'Std Name',
            'std_father_name' => 'Std Father Name',
            'std_gender' => 'Std Gender',
            'std_dob' => 'Std Dob',
            'std_address' => 'Std Address',
            'std_mobile_no' => 'Std Mobile No',
            'std_cnic'  => 'Std CNIC No',
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
        return $this->hasMany(StdEnrollment::className(), ['std_id' => 'std_id']);
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
    * Gets query for [[AssignmentSubmits]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAssignmentSubmits() 
   { 
       return $this->hasMany(AssignmentSubmit::className(), ['std_id' => 'std_id']); 
   } 
 
   /** 
    * Gets query for [[QuizzRemarks]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getQuizzRemarks() 
   { 
       return $this->hasMany(QuizzRemarks::className(), ['std_id' => 'std_id']); 
   }
}
