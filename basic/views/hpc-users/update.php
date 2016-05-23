<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HpcUsers */

$this->title = 'Update Hpc Users: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Hpc Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->user_number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hpc-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
