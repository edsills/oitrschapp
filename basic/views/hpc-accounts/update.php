<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HpcAccounts */

$this->title = 'Update Hpc Accounts: ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Hpc Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'login' => $model->login, 'machine_name' => $model->machine_name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hpc-accounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
