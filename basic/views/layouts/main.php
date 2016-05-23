<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- NC State Bootstrap CSS -->
<link href="https://cdn.ncsu.edu/brand-assets/bootstrap/css/bootstrap.css"
      rel="stylesheet" media="screen" type="text/css" />

<!-- jQuery 2.1.0 -->
     <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<!-- Bootstrap JS -->
     <script src="https://cdn.ncsu.edu/brand-assets/bootstrap/js/bootstrap.min.js">
</script>

    <script src="https://cdn.ncsu.edu/brand-assets/utility-bar/ub.php?googleCustomSearchCode=[INSERT CUSTOM SEARCH CODE]&placeholder=[INSERT CUSTOM SEARCH PLACEHOLDER]&maxWidth=1100&color=black&showBrick=1"></script>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div id="ncstate-utility-bar"></div>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'User', 'url' => ['/site/user']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<!---
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
--->

<div class="sub-footer">
     <div class="container">
	<h4><a href="http://www.ncsu.edu/"><strong>NC STATE</strong> UNIVERSITY</a></h4>
	<p class="pull-left">
	<address>
	<span><strong>NORTH CAROLINA STATE UNIVERSITY</strong></span>
	<span>RALEIGH, NC 27695</span>
	<span>919.515.2011</span>
	</address></p>
	<p class="pull-right">
	&copy; <?php echo date('Y'); ?> NC State University
	<p>
	</div><!-- .container -->
</div><!-- .sub-footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
