<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/06
 * Time: 19:37
 */
use yii\helpers\Url;
use yii\widgets\ListView;
use frontend\models\SelectedSeeker;
use frontend\models\BookmarkSeeker;
?>


<div class="container-fluid">

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

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">

            <div class="col-md-4 panelink">
                <a href="<?=Url::to(['seeker/seekeralloffers'])?>" >
                    <div class="panel panel-info mypanel  text-center">
                        <div class="panel-heading">
                            Job Offers
                            <?php

                            $bookmarks = new BookmarkSeeker();
                            $selected_seeker = new SelectedSeeker();
                            $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
                            $number = $selected_seeker->number_of_new_jobs_offered($seeker_id);

                            if($number>0) {
                                ?>
                                <span class="label label-danger "><?=$number?></span>
                                <?php
                            }
                            ?>
                        </div>


                        <div class="panel-body ">
                            <i class="fa fa-briefcase fa-3x"></i>

                            <p><?=$selected_seeker->number_of_jobs_offered($seeker_id)?> </p>
                        </div>


                    </div>
                </a>
            </div>

            <div class="col-md-4 panelink">
                <a href="#" >
           <div class="panel panel-info mypanel  text-center">
               <div class="panel-heading">
                   You Got Bookmarked!
               </div>


               <div class="panel-body ">

                   <i class="fa fa-eye fa-3x"></i>
                   <p><?=$bookmarks->seeker_bookmarks($seeker_id)->count()?> </p>
               </div>


           </div>
                </a>
            </div>





            <div class="col-md-4 panelink">
                <a href="#" >
                    <div class="panel panel-info mypanel  text-center">
                        <div class="panel-heading">
                            They Selected You!
                        </div>


                        <div class="panel-body ">

                            <i class="fa fa-business-time fa-3x"></i>
                            <p><?=$selected_seeker->number_of_job_selections($seeker_id)?> </p>
                        </div>


                    </div>
                </a>
            </div>



        </div>
        <div class="col-md-2">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">




<h4><i class="far fa-list-ol text-success"></i> List of Jobs offered</h4>
<?php
echo ListView::widget([
        'dataProvider'=>$model,
        'itemView'=>'seekeroffer',
        'emptyText'=>'No new offers!'

])

?>





            <div class="col-md-2">
            </div>
        </div>
    </div>

</div>


<!--   -->


