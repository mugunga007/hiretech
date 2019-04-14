<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/25
 * Time: 22:20
 */

use yii\widgets\ListView;
?>

<div class="col-md-8">

    <?php

    echo ListView::widget([
        'dataProvider'=>$model,
        'itemView'=>'_seeker'
    ]);


    ?>

</div>
