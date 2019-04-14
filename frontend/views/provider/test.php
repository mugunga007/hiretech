<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/03/13
 * Time: 6:38
 */
use yii\helpers\Url;
use yii\widgets\Pjax;
/* Automatic refresh button */

?>
<!--The following button reloads the page because is not inside the pjax -->
<div class="row">
    <div class="col-md-3">
        <a  href="<?=Url::to(['provider/test'])?>" class="btn btn-primary" type="button" >Refresh outside Pjax</a>
    </div>
</div>
<div class="row">
    <div class="col-md-3">

        <!-- PJAX begining -->
        <?php Pjax::begin();?>
        <h1>Current time: <?=$time?></h1>
        <!--The following button reloads/updates data without reloading the page because is inside the pjax -->
        <a  href="<?=Url::to(['provider/test'])?>" class="btn btn-primary" type="button" id="refreshButton">Refresh inside Pjax</a>


        <?php Pjax::end();?>
        <!-- PJAX Ending -->


    </div>
</div>