<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Provider */


?>
<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>

        <div class="col-md-4">

 <div data-aos="fade-left">
<div class="myform">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
 </div>
    </div>



        <div class="col-md-2">
        </div>


    </div>
</div>

