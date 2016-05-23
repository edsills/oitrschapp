<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\HpcDepartments;
use app\models\HpcMachineNames;

/* @var $this yii\web\View */
/* @var $model app\models\HpcProjects */
/* @var $form yii\widgets\ActiveForm */

$deptList = HpcDepartments::find()->all();
$listdata = ArrayHelper::map($deptList,'department_id','department');
$model->project_type = 'EM';
$model->program_id = 0;

$machList = HpcMachineNames::find()->all();
$machdata = ArrayHelper::map($machList,'machine_name','model');

?>

<div class="hpc-projects-form">

    <?php $form = ActiveForm::begin([
    	  'options' => ['class' => 'form-horizontal'],
	  'fieldConfig' => [
	     'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
	  'labelOptions' => ['class' => 'col-lg-1 control-label'],
	  ],
	]
    ); ?>

    <?= $form->field($usermodel, 'user_number')->hiddenInput()->label(false) ?>

    <?= $form->field($usermodel, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($usermodel, 'firstname')->textInput(['maxlength' => true])->label('First Name') ?>

    <?= $form->field($usermodel, 'middleinitial')->textInput(['maxlength' => true])->label('Middle Initial') ?>

    <?= $form->field($usermodel, 'lastname')->textInput(['maxlength' => true])->label('Last Name') ?>

    <?= $form->field($usermodel, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($usermodel, 'department_id')->dropDownList(
    	$listdata
    )->label('Department') ?>

    <?= $form->field($usermodel, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($usermodel, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'user_number')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'project_type')->dropDownList(
    	['EM'=>'Research Project',
         'EC'=>'Course Project']
    ); ?>

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_id')->hiddenInput()->label(false) ?>

    <?= $form->field($acctmodel, 'login')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($acctmodel, 'machine_name')->dropDownList(
        $machdata
    )->label('System') ?>

    <?= $form->field($acctmodel, 'project_id')->hiddenInput()->label(false) ?>

    <?= $form->field($acctmodel, 'user_number')->hiddenInput()->label(false) ?>

    <?= $form->field($acctmodel, 'status')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($acctmodel, 'user_id')->textInput(['readonly' => true])->label('UID') ?>

    <?= $form->field($acctmodel, 'pin')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($acctmodel, 'shell')->textInput(['maxlength' => true, 'readonly' => true]) ?>


<!---
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
--->

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
