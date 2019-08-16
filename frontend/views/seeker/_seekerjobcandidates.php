<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/05
 * Time: 20:05
 */

use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use frontend\models\SeekerSearchForm;
use frontend\models\SelectedSeeker;
use frontend\models\BookmarkSeeker;
use frontend\models\ProviderJob;

?>




<div class="seekerslist">


    <div class="row">
        <?php
        $cri = new SeekerSearchForm();

        //Create a DateTime object using the user's date of birth.
        $dob = new DateTime($model->dob);

        //We need to compare the user's date of birth with today's date.
        $now = new DateTime();

        //Calculate the time difference between the two dates.
        $difference = $now->diff($dob);

        //Get the difference in years, as we are looking for the user's age.
        $age = $difference->y;

        $providerid = Yii::$app->user->identity->provider->provider_id;
        $selected = new SelectedSeeker();
        $provider_job = new ProviderJob();
        ?>

        <div class="col-md-4 col-sm-6  ">
            <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">
        </div>
        <div class="col-md-8 col-sm-6 ">
<!---  -->
            <?php
            $check_selected = false;
            if($selected->selected($providerid,$model->seeker_id)) {
                $check_selected = true;
                $provider_job_id = $selected->selected_model($providerid, $model->seeker_id)
                    ->provider_job_id;


                ?>
                <h4 >
                    <span class="label label-default right_top">
                    <i class="fa fa-user-tag"></i>
                        <?= ucfirst($provider_job->getProviderJob($provider_job_id)->job_title) ?>
                        <i class="fa fa-check-circle "></i>
                    </span>
                </h4>
                <?php
            }
            ?>

<!---  -->

            <h3><?=$model->firstname?> <?=$model->lastname?>, <b><?=strtoupper(substr($model->gender,0,1))?>,<?=$age?>
                    <?php
                    // date_diff(date_create($dob),date_create($today))->format('%Y')
                    ?>
                </b></h3>
            <p><i class="fa fa-map-marker-alt"> </i> <?=$model->address?></p>

            <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
                <?php
                $seekerjobtypes = $model->seekerJobTypes;
                foreach($seekerjobtypes as $jobtypes){
                    ?>
                    <i class="fa fa-check-circle"> </i><?=$jobtypes->jobType->title?>
                    <?php
                }
                ?>
            </h5>
            <h5><i class="fa fa-user-graduate"></i> <b>Experience:</b> <?=$model->experience?> </h5>



            <?php
            $session = Yii::$app->session;
            $selected = new SelectedSeeker();
            if($selected->selectedcandidatesbyjob($providerid,$model->seeker_id,$provider_job_id)) {
                ?>

                <a type="button" class="btn btn-danger"
                   href="<?= Url::to(['provider/unselectseeker', 'seekerid' => $model->seeker_id,
                       'providerid' => Yii::$app->user->identity->provider->provider_id,
                       'provider_job_id'=>$provider_job_id]) ?>"
                >
                    Cancel
                    <i class="fa fa-window-close"></i></a>

                <?php
            }else {
                ?>

                <a type="button" class="btn btn-primary"
                   href="<?= Url::to(['provider/selectseeker',
                       'seekerid' => $model->seeker_id,
                       'providerid' => Yii::$app->user->identity->provider->provider_id,
                       'jobtypeid' => $jobtypeid,
                       'projobid'=>$session->get('projobid')]) ?>"
                >
                    <i class="far fa-check-circle"></i> Select </a>

                <?php
            }
            ?>



            <?php
            Modal::begin([
                'header' => '<h2>'. $model->firstname.' '.$model->lastname .'</h2>',
                'toggleButton' => ['label' => ' <i class="far fa-user"></i> Profile','id'=>'profile','class'=>'btn btn-success'],


            ]);

            ?>



            <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">


            <h3> <b><?=strtoupper(substr($model->gender,0,1))?>,

                    <?php
                    // date_diff(date_create($dob),date_create($today))->format('%Y')?>

                </b></h3>
            <p><i class="fa fa-map-marker-alt"> </i> <?=$model->address?></p>

            <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
                <?php
                $seekerjobtypes = $model->seekerJobTypes;
                foreach($seekerjobtypes as $jobtypes){
                    ?>
                    <i class="far fa-check-circle"> </i><?=$jobtypes->jobType->title?>
                    <?php
                }
                ?>
            </h5>
            <h5><i class="fa fa-user-graduate"></i> <b>Experience:</b> <?=$model->experience?> </h5>

            <?php


            Modal::end();

            ?>



            <?php Pjax::begin([]);?>
            <?php

            $bookmark_seeker = new BookmarkSeeker();
            if($bookmark_seeker->getBookmark($providerid,$model->seeker_id)!=null) {
                ?>

                <a href="<?=Url::to(['provider/unbookmarkjobcandidates',
                    'provider_job_id'=>$provider_job_id,
                    'provider_id'=>$providerid,
                    'seeker_id'=>$model->seeker_id,
                    'address'=>$address,
                    'jobtypeid'=>$jobtypeid,
                    'min_age'=>$min_age,
                    'max_age'=>$max_age,
                    'gender'=>$gender,
                    'page'=>$page,
                   // 'per-page'=>$per_page,
                ])?>"
                   class="bookmark_icon"><i class="fa fa-bookmark fa-2x mytext-right myfavoriteyes bookmarked">
                    </i></a>

                <?php
            }else {
                ?>

                <a href="<?= Url::to(['provider/bookmarkjobcandidates',
                    'provider_job_id'=>$provider_job_id,
                    'provider_id' => $providerid,
                    'seeker_id' => $model->seeker_id,
                    'address'=>$address,
                    'jobtypeid'=>$jobtypeid,
                    'min_age'=>$min_age,
                    'max_age'=>$max_age,
                    'gender'=>$gender,
                    'page'=>$page,
                   // 'per_page'=>$per_page,


                ]) ?>" class="bookmark_icon"><i class="far fa-bookmark fa-2x mytext-right myfavoriteyes ">
                    </i></a>
                <?php
            }

            ?>

            <?php Pjax::end();?>


        </div>
    </div>
</div>


