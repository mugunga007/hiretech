<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderJob */

?>

            <?=$this->render('../provider/prodashlayout')?>


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


