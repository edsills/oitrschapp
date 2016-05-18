<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HpcProjects */

$this->title = $model->project_id;
$this->params['breadcrumbs'][] = ['label' => 'Hpc Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpc-projects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->project_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_id',
            'user_number',
            'project_type',
            'group_name',
            'program_id',
        ],
    ]) ?>

</div>
