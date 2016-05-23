<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_project_types".
 *
 * @property string $project_type
 * @property string $project
 *
 * @property HpcProjects[] $hpcProjects
 */
class HpcProjectTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_project_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_type', 'project'], 'required'],
            [['project_type'], 'string', 'max' => 2],
            [['project'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_type' => 'Project Type',
            'project' => 'Project',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcProjects()
    {
        return $this->hasMany(HpcProjects::className(), ['project_type' => 'project_type']);
    }
}
