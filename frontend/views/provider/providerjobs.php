<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/03/07
 * Time: 21:22
 */

?>


            <?=$this->render('prodashlayout')?>


    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <?=$this->render('/provider-job/_form',[
                    'model'=>$model,
            ])?>
        </div>
        <div class="col-md-2">
        </div>
    </div>


