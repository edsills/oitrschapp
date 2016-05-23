<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_program_ids".
 *
 * @property integer $program_id
 * @property string $program
 *
 * @property HpcProjects[] $hpcProjects
 */
class HpcProgramIds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_program_ids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['program_id', 'program'], 'required'],
            [['program_id'], 'integer'],
            [['program'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'program_id' => 'Program ID',
            'program' => 'Program',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcProjects()
    {
        return $this->hasMany(HpcProjects::className(), ['program_id' => 'program_id']);
    }
}
