<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/02/01
 * Time: 12:17
 */

use yii\widgets\ListView;
?>
<?php



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
            <div class="well well-sm text-center"><i class="fa fa-user-graduate"></i> Candidates You Confirmed for <b><?=ucfirst($job_title)?></b> Offer </div>
            <?php

            echo ListView::widget([
                'dataProvider'=>$selectedlist,
                'itemView'=>'/seeker/_confirmedseeker',
                'emptyText'=>'No Selected Candidates yet!',
                'viewParams'=>[
                        'provider_job_id'=>$provider_job_id,
                ]

            ])

            ?>

        </div>

    </div>

</div>
