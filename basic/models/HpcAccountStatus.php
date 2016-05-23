<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_account_status".
 *
 * @property string $status
 * @property string $description
 *
 * @property HpcAccounts[] $hpcAccounts
 */
class HpcAccountStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_account_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'description'], 'required'],
            [['status'], 'string', 'max' => 1],
            [['description'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Status',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcAccounts()
    {
        return $this->hasMany(HpcAccounts::className(), ['status' => 'status']);
    }
}
