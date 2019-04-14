<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/03/28
 * Time: 21:20
 */

use frontend\models\BookmarkSeeker;
use frontend\models\JobType;
use yii\helpers\Url;
use frontend\models\ProviderJob;
?>

<?php
$provider_job = new ProviderJob();
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

    <?php
    $jobtype = new JobType();
    $book = new BookmarkSeeker();
    $provider_id = Yii::$app->user->identity->provider->provider_id;
    foreach ($distinct_bookmarks as $db) {

        ?>


        <div class="col-sm-3 text-center ">
            <a href="<?=Url::to(['provider/jobtypebookmarks','job_type_id'=>$db->job_type_id])?>" class="" >
                <div class="dashdiv ">



                    <i class="fa fa-users fa-2x  "></i>
                    <p> <small >Saved <?=$jobtype->getJobType($db->job_type_id)->title?>(s)</small></p>
                    <h4><b> <?=$book->number_of_bookmarks_per_job_type($provider_id,$db->job_type_id) ?></b></h4>


                </div>
            </a>
        </div>

        <?php
    }
    ?>

</div>
