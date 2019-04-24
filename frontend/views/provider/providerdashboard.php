<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/12
 * Time: 0:07
 */

//use yii\widgets\ActiveForm;
use frontend\models\JobType;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>
<div class="container">
    <div class="row  ">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 ">
            <?=$this->render('prodashlayout')?>
        </div>
        <div class="col-md-1">
        </div>

    </div>

    <div class="row">

        <div class="col-md-2">
        </div>

        <div class="col-md-8">

            <?php
            echo ListView::widget([
                    'dataProvider'=>$provider_job,
                'itemView' => '_dashboard_provider_job',
                'emptyText'=>' <a href=""><i class="fa fa-briefcase"></i> Start by Create an Offer</a>'
            ])
            ?>



        </div>

        <div class="col-md-2">
        </div>
    </div>
</div>