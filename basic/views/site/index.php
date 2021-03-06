<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'OIT Research Services Application';

$id = Yii::$app->user->identity->username;

?>

<div class="site-index">

    <div class="jumbotron">
        <h1>OIT Research Services</h1>
        <?php echo Html::img('@web/images/dc2-2.jpg',['alt' => 'background image',
                          'width' => '100%']) ?>
<!---
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
--->
    </div>

    <div class="body-content">

        <div class="row">
		<div class="col-lg-12">
		     <h3> <?php echo "$id"; ?> </h3>
		</div>
	</div>

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <h2>Unclaimed Storage</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
		<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Claim Storage</a></p>
<!---
                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
--->
            </div>
            <div class="col-lg-4 col-sm-6">
                <h2>Manage Storage</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

		<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Manage Storage</a></p>
<!---
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
--->
            </div>
            <div class="col-lg-4 col-sm-6">
                <h2>Manage HPC Project</h2>

		<?php
		    echo "<p> <h5>cn</h5>";
		    print_r($result[0]['cn'][0]);
		    echo "<p> <h5>uidnumber</h5>";
		    print_r($result[0]['uidnumber'][0]);
		    if ($projects) {
  		       echo "<p> <h5>Projects</h5>";

		       echo "<ul>\n";
		       foreach ($projects as $p) {
		       	  echo "<li> $p[project_id] - $p[group_name]\n";
		       }
		       echo "</ul>\n";

		       echo '<p><a class="btn btn-lg btn-success" href="/basic/web/index.php?r=hpc-projects/manage">Manage HPC Projects</a></p>';
		    } else {
		       echo "<p>No Currently Active Projects</p>";
		       echo '<p><a class="btn btn-lg btn-success" href="/basic/web/index.php?r=hpc-projects/create">Request HPC Project</a></p>';
		    }
 		?>



            </div>
        </div>

    </div>
</div>
