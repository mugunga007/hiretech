<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/02/27
 * Time: 17:16
 */

use yii\grid\GridView;
?>

<div class="container">
    <div class="row ">
        <div class="col-md-1" >

        </div>
        <div class="col-md-10 " >


            <?=$this->render('seekerdashlayout')?>


            <hr>
        </div>

        <div class="col-md-1">
        </div>

    </div>

    <?php

    echo GridView::widget([
        'dataProvider'=>$model,
        'columns'=>[
            'status',
            'provider_job_id',
            ['class'=>'yii\grid\ActionColumn']
        ]
    ])

    ?>


</div>
