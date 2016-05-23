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
 *
 * @property HpcAccounts[] $hpcAccounts
 * @property HpcUsers $userNumber
 * @property HpcProgramIds $program
 * @property HpcProjectTypes $projectType
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
            [['user_number'], 'exist', 'skipOnError' => true, 'targetClass' => HpcUsers::className(), 'targetAttribute' => ['user_number' => 'user_number']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => HpcProgramIds::className(), 'targetAttribute' => ['program_id' => 'program_id']],
            [['project_type'], 'exist', 'skipOnError' => true, 'targetClass' => HpcProjectTypes::className(), 'targetAttribute' => ['project_type' => 'project_type']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getHpcAccounts()
    {
        return $this->hasMany(HpcAccounts::className(), ['project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserNumber()
    {
        return $this->hasOne(HpcUsers::className(), ['user_number' => 'user_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(HpcProgramIds::className(), ['program_id' => 'program_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne(HpcProjectTypes::className(), ['project_type' => 'project_type']);
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
