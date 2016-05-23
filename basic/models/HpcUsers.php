<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_users".
 *
 * @property integer $user_number
 * @property string $title
 * @property string $firstname
 * @property string $middleinitial
 * @property string $lastname
 * @property string $position
 * @property integer $department_id
 * @property string $email
 * @property string $phone
 *
 * @property HpcAccounts[] $hpcAccounts
 * @property HpcProjects[] $hpcProjects
 * @property HpcDepartments $department
 */
class HpcUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_number', 'firstname', 'lastname'], 'required'],
            [['user_number', 'department_id'], 'integer'],
            [['title'], 'string', 'max' => 10],
            [['firstname', 'lastname', 'position', 'email'], 'string', 'max' => 40],
            [['middleinitial'], 'string', 'max' => 1],
            [['phone'], 'string', 'max' => 20],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => HpcDepartments::className(), 'targetAttribute' => ['department_id' => 'department_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_number' => 'User Number',
            'title' => 'Title',
            'firstname' => 'Firstname',
            'middleinitial' => 'Middleinitial',
            'lastname' => 'Lastname',
            'position' => 'Position',
            'department_id' => 'Department ID',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcAccounts()
    {
        return $this->hasMany(HpcAccounts::className(), ['user_number' => 'user_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcProjects()
    {
        return $this->hasMany(HpcProjects::className(), ['user_number' => 'user_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(HpcDepartments::className(), ['department_id' => 'department_id']);
    }

    /**
     * @inheritdoc
     * @return HpcUsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HpcUsersQuery(get_called_class());
    }
}
