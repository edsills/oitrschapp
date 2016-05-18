<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[HpcProjects]].
 *
 * @see HpcProjects
 */
class HpcProjectsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return HpcProjects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HpcProjects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
