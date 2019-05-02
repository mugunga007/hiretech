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


            <?=$this->render('seekerdashlayout')?>



<div class="row">



    <?php
    echo ListView::widget([
        'dataProvider'=>$model,
        'itemView'=>'_seekeroffers',
        'emptyText'=>'No Offers Yet!'

    ])

    ?>

</div>

</div>
