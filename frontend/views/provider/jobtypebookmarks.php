<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/03/29
 * Time: 12:48
 */

use yii\widgets\ListView;
use frontend\models\JobType;
?>

<?php


?>




            <?=$this->render('prodashlayout')?>


    <div class="row">

        <div class="col-md-2">
        </div>

        <div class="col-md-8 ">
            <h3 class="text-center"><i class="fa fa-bookmark"></i> Saved <?=$jobtype->title?>(s)</h3>
            <?php
            echo ListView::widget([
                'dataProvider'=>$job_type_bookmarks,
                'itemView'=>'/seeker/_bookmarked',
                'viewParams'=>[
                        'jobtypeid'=>$jobtype->job_type_id
                ]

            ])
            ?>
        </div>

        <div class="col-md-2">
        </div>
    </div>





