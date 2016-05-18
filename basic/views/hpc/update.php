<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HpcProjects */

$this->title = 'Update Hpc Projects: ' . $model->project_id;
$this->params['breadcrumbs'][] = ['label' => 'Hpc Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_id, 'url' => ['view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hpc-projects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
