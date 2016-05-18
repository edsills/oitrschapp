<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[HpcAccounts]].
 *
 * @see HpcAccounts
 */
class HpcAccountsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return HpcAccounts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HpcAccounts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
