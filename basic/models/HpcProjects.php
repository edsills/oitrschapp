<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_projects".
 *
 * @property integer $project_id
 * @property integer $user_number
 * @property string $project_type
 * @property string $group_name
 * @property integer $program_id
 */
class HpcProjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'user_number', 'project_type', 'program_id'], 'required'],
            [['project_id', 'user_number', 'program_id'], 'integer'],
            [['project_type'], 'string', 'max' => 2],
            [['group_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'user_number' => 'User Number',
            'project_type' => 'Project Type',
            'group_name' => 'Group Name',
            'program_id' => 'Program ID',
        ];
    }

    /**
     * @inheritdoc
     * @return HpcProjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HpcProjectsQuery(get_called_class());
    }
}
