<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderJob */

?>
<div class="container">

    <div class="row  ">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 ">
            <?=$this->render('../provider/prodashlayout')?>
        </div>
        <div class="col-md-1">
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="myform">
            <?=$this->render('_form',[
                'model'=>$model,
            ])?>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>

</div>
