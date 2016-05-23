<?php

use yii\helpers\Html;
use yii\db\Command;

/* @var $this yii\web\View */
/* @var $model app\models\HpcProjects */

$this->title = 'Create Hpc Project';
$this->params['breadcrumbs'][] = ['label' => 'Hpc Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpc-projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php print_r($result); ?>


    <?= $this->render('_form', [
        'model' => $model,
	'usermodel' => $usermodel,
	'acctmodel' => $acctmodel,
    ]) ?>

</div>
