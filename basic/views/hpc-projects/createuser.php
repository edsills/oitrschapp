<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HpcUser */

$this->title = 'Create Hpc User';
$this->params['breadcrumbs'][] = ['label' => 'Hpc Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpc-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_userform', [
        'model' => $model,
    ]) ?>

</div>
