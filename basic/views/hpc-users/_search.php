<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HpcUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hpc-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_number') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'middleinitial') ?>

    <?= $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'department_id') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
