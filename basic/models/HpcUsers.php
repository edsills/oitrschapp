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
 * @property integer $institution_id
 * @property string $department
 * @property string $email
 * @property string $phone
 *
 * @property HpcDepartments $department0
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
            [['user_number', 'firstname', 'lastname', 'institution_id', 'department'], 'required'],
            [['user_number', 'institution_id'], 'integer'],
            [['title'], 'string', 'max' => 10],
            [['firstname', 'lastname', 'position', 'email'], 'string', 'max' => 40],
            [['middleinitial'], 'string', 'max' => 1],
            [['department'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['department', 'institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => HpcDepartments::className(), 'targetAttribute' => ['department' => 'department', 'institution_id' => 'institution_id']],
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
            'institution_id' => 'Institution ID',
            'department' => 'Department',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasOne(HpcDepartments::className(), ['department' => 'department', 'institution_id' => 'institution_id']);
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
