<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HpcProjects */

$this->title = 'Create Hpc Projects';
$this->params['breadcrumbs'][] = ['label' => 'Hpc Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpc-projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
