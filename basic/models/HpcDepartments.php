<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_departments".
 *
 * @property integer $department_id
 * @property string $department
 * @property string $department_abbr
 * @property string $college_id
 * @property integer $institution_id
 *
 * @property HpcInstitutions $institution
 * @property HpcUsers[] $hpcUsers
 */
class HpcDepartments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'department', 'department_abbr', 'college_id', 'institution_id'], 'required'],
            [['department_id', 'institution_id'], 'integer'],
            [['department'], 'string', 'max' => 100],
            [['department_abbr', 'college_id'], 'string', 'max' => 16],
            [['department', 'institution_id'], 'unique', 'targetAttribute' => ['department', 'institution_id'], 'message' => 'The combination of Department and Institution ID has already been taken.'],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => HpcInstitutions::className(), 'targetAttribute' => ['institution_id' => 'institution_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department' => 'Department',
            'department_abbr' => 'Department Abbr',
            'college_id' => 'College ID',
            'institution_id' => 'Institution ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitution()
    {
        return $this->hasOne(HpcInstitutions::className(), ['institution_id' => 'institution_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcUsers()
    {
        return $this->hasMany(HpcUsers::className(), ['department_id' => 'department_id']);
    }
}
