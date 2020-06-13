<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "semester_subjects".
 *
 * @property int $sem_subj_id
 * @property string $subj_1_title
 * @property string $subj_1_description
 * @property string $subj_2_title
 * @property string $subj_2_description
 * @property string $subj_3_title
 * @property string $subj_3_description
 * @property string|null $subj_4_title
 * @property string|null $subj_4_description
 * @property string|null $subj_5_title
 * @property string|null $subj_5_description
 * @property string|null $subj_6_title
 * @property string|null $subj_6_description
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 */
class SemesterSubjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester_subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subj_1_title', 'subj_1_description', 'subj_2_title', 'subj_2_description', 'subj_3_title', 'subj_3_description', 'created_by', 'created_at'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['subj_1_title', 'subj_2_title', 'subj_3_title', 'subj_4_title', 'subj_5_title', 'subj_6_title'], 'string', 'max' => 100],
            [['subj_1_description', 'subj_2_description', 'subj_3_description', 'subj_4_description', 'subj_5_description', 'subj_6_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sem_subj_id' => 'Sem Subj ID',
            'subj_1_title' => 'Subj 1 Title',
            'subj_1_description' => 'Subj 1 Description',
            'subj_2_title' => 'Subj 2 Title',
            'subj_2_description' => 'Subj 2 Description',
            'subj_3_title' => 'Subj 3 Title',
            'subj_3_description' => 'Subj 3 Description',
            'subj_4_title' => 'Subj 4 Title',
            'subj_4_description' => 'Subj 4 Description',
            'subj_5_title' => 'Subj 5 Title',
            'subj_5_description' => 'Subj 5 Description',
            'subj_6_title' => 'Subj 6 Title',
            'subj_6_description' => 'Subj 6 Description',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
