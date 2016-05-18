<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_accounts".
 *
 * @property string $login
 * @property string $machine_name
 * @property integer $project_it
 * @property integer $user_number
 * @property string $status
 * @property integer $user_id
 * @property string $pin
 * @property string $shell
 *
 * @property HpcMachineNames $machineName
 */
class HpcAccounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'machine_name', 'project_it', 'user_number', 'status', 'user_id', 'shell'], 'required'],
            [['project_it', 'user_number', 'user_id'], 'integer'],
            [['login', 'pin'], 'string', 'max' => 8],
            [['machine_name'], 'string', 'max' => 16],
            [['status'], 'string', 'max' => 1],
            [['shell'], 'string', 'max' => 12],
            [['machine_name'], 'exist', 'skipOnError' => true, 'targetClass' => HpcMachineNames::className(), 'targetAttribute' => ['machine_name' => 'machine_name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'machine_name' => 'Machine Name',
            'project_it' => 'Project It',
            'user_number' => 'User Number',
            'status' => 'Status',
            'user_id' => 'User ID',
            'pin' => 'Pin',
            'shell' => 'Shell',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachineName()
    {
        return $this->hasOne(HpcMachineNames::className(), ['machine_name' => 'machine_name']);
    }

    /**
     * @inheritdoc
     * @return HpcAccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HpcAccountsQuery(get_called_class());
    }
}
