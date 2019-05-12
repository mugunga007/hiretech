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




            <?=$this->render('seekerdashlayout')?>



<div class="row">

<div class="col-md-2">
</div>

    <div class="col-md-8">

    <?php
    echo ListView::widget([
        'dataProvider'=>$model,
        'itemView'=>'_seekeroffers',
        'emptyText'=>'No Offers Yet!'

    ])

    ?>
    </div>

    <div class="col-md-2">
    </div>

</div>


