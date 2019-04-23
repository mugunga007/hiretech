<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/02/27
 * Time: 17:16
 */

use yii\grid\GridView;
use yii\widgets\ListView;
?>

<div class="container">
    <div class="row ">
        <div class="col-md-2" >

        </div>
        <div class="col-md-8 " >


            <?=$this->render('seekerdashlayout')?>


            <hr>
        </div>

        <div class="col-md-2">
        </div>

    </div>
<div class="row">



    <?php
    echo ListView::widget([
        'dataProvider'=>$model,
        'itemView'=>'seekeroffer',
        'emptyText'=>'No new offers!'

    ])

    ?>

</div>

</div>
