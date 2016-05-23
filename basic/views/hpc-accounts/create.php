<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HpcAccounts */

$this->title = 'Create Hpc Accounts';
$this->params['breadcrumbs'][] = ['label' => 'Hpc Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpc-accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
