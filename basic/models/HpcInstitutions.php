<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hpc_institutions".
 *
 * @property integer $institution_id
 * @property string $institution_name
 * @property string $institution_abbr
 *
 * @property HpcDepartments[] $hpcDepartments
 */
class HpcInstitutions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hpc_institutions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institution_id', 'institution_name', 'institution_abbr'], 'required'],
            [['institution_id'], 'integer'],
            [['institution_name'], 'string', 'max' => 80],
            [['institution_abbr'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'institution_id' => 'Institution ID',
            'institution_name' => 'Institution Name',
            'institution_abbr' => 'Institution Abbr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHpcDepartments()
    {
        return $this->hasMany(HpcDepartments::className(), ['institution_id' => 'institution_id']);
    }
}
