<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assignment_remarks".
 *
 * @property int $assign_remark_id
 * @property int $assign_id
 * @property int $assign_sub_id
 * @property string $obt_marks
 * @property string $remarks
 * @property string $created_at
 *
 * @property AssignmentUpload $assign
 * @property AssignmentSubmit $assignSub
 */
class AssignmentRemarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment_remarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assign_id', 'assign_sub_id', 'obt_marks', 'remarks', 'created_at'], 'required'],
            [['assign_id', 'assign_sub_id'], 'integer'],
            [['remarks'], 'string'],
            [['created_at'], 'safe'],
            [['obt_marks'], 'string', 'max' => 20],
            [['assign_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssignmentUpload::className(), 'targetAttribute' => ['assign_id' => 'assign_id']],
            [['assign_sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssignmentSubmit::className(), 'targetAttribute' => ['assign_sub_id' => 'assign_sub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assign_remark_id' => 'Assign Remark ID',
            'assign_id' => 'Assign ID',
            'assign_sub_id' => 'Assign Sub ID',
            'obt_marks' => 'Obt Marks',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Assign]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssign()
    {
        return $this->hasOne(AssignmentUpload::className(), ['assign_id' => 'assign_id']);
    }

    /**
     * Gets query for [[AssignSub]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignSub()
    {
        return $this->hasOne(AssignmentSubmit::className(), ['assign_sub_id' => 'assign_sub_id']);
    }
}
