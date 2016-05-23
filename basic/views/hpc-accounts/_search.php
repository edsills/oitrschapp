<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HpcAccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hpc-accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'login') ?>

    <?= $form->field($model, 'machine_name') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'user_number') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'pin') ?>

    <?php // echo $form->field($model, 'shell') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
