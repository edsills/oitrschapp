<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

?>

<?php if ($modelCanSave) { ?>
<div class="alert alert-success">
     Model ready to be saved!
</div>

<?php } ?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
     <div class="col-lg-6">
     <h3> PI Form </h3>
     <?php echo $form->field($model,'firstname')->textInput(); ?>
     <?php echo $form->field($model,'lastname')->textInput(); ?>
     <?php echo $form->field($model,'institution_id')->dropDownList(
     	   ['10000'=>'NC State',
	    '13000'=>'UNC Greensboro']); ?>
     <?php echo $form->field($model,'email')->textInput(); ?>
     </div>
</div>
<div class="form-group">
     <?php echo Html::submitButton('Create',
     	   ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
