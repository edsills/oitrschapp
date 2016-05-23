<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HpcAccounts */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Hpc Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpc-accounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'login' => $model->login, 'machine_name' => $model->machine_name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'login' => $model->login, 'machine_name' => $model->machine_name], [
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
            'login',
            'machine_name',
            'project_id',
            'user_number',
            'status',
            'user_id',
            'pin',
            'shell',
        ],
    ]) ?>

</div>
