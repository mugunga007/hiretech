<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/08/14
 * Time: 15:46
 */

use yii\grid\GridView;
use frontend\models\ProviderJob;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>


<?=$this->render('prodashlayout')?>

<div class="row">
    <div class="col-md-12">







        <hr>

        <?php

        // foreach ($providerjoblist as $projob) {
        ?>

        <?php
        //   }
        ?>

        <?php
        /*
        $pro = new ProviderJob();
        $now = date('Y-m-d h:i:s');

        echo $pro->get_time_ago(strtotime("2013-12-01") );
         echo $now.'<br/>';
       echo $pro->time_elapsed_string($now);
        */
        ?>

        <?php

        echo ListView::widget([
            'dataProvider'=>$dataProvider,
            'itemView'=>'../provider-job/_providerjob',
            'emptyText'=>'No Offers Registered Yet'
        ])

        ?>
    </div>



</div>


