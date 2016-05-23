<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_machine_names".
 *
 * @property string $machine_name
 * @property string $vendor
 * @property string $model
 *
 * @property HpcAccounts[] $hpcAccounts
 * @property HpcAccounts[] $hpcAccounts0
 */
class HpcMachineNames extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_machine_names';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['machine_name'], 'required'],
            [['machine_name'], 'string', 'max' => 16],
            [['vendor', 'model'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'machine_name' => 'Machine Name',
            'vendor' => 'Vendor',
            'model' => 'Model',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcAccounts()
    {
        return $this->hasMany(HpcAccounts::className(), ['machine_name' => 'machine_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcAccounts0()
    {
        return $this->hasMany(HpcAccounts::className(), ['machine_name' => 'machine_name']);
    }
}
