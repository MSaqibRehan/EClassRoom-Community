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
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property Semester[] $semesters
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
            [['cp_name', 'no_of_semesters', 'status', 'created_by', 'created_at'], 'required'],
            [['no_of_semesters', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
            'cp_name' => 'Cp Name',
            'no_of_semesters' => 'No Of Semesters',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
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
}
