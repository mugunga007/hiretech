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


            <?=$this->render('prodashlayout')?>


    <div class="row">

        <div class="col-md-2">
        </div>

        <div class="col-md-8 text-center">

            <?php
            echo ListView::widget([
                    'dataProvider'=>$provider_job,
                'itemView' => '_dashboard_provider_job',
                'emptyText'=>'  <i class="fa fa-exclamation-triangle fa-2x text-warning"></i> Looks empty here
                 <a href="'.Url::to('provider/providerjobs').'"><br/><br/> <i class="fa fa-folder-plus "></i> Start by Creating an Offer</a>
                 <br/><br/> Or
                 <br/><br/> <i class="fa fa-search text-primary "></i>  <a href="'.Url::to('prodashsearch').'">Search Available Employees</a>
                 <br/><br/> <i class="fa fa-hand-point-up fa-6x text-success"></i>
                 '
            ])
            ?>



        </div>

        <div class="col-md-2">
        </div>
    </div>
