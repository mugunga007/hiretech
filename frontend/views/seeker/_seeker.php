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
use frontend\models\JobType;
use frontend\models\SeekerNotification;
?>




<div class="seekerslist">


    <div class="row">
        <?php
        $jobtype = new JobType();

        $provider_job = new ProviderJob();

        $cri = new SeekerSearchForm();
        //Create a DateTime object using the user's date of birth.
        $dob = new DateTime($model->dob);

        //We need to compare the user's date of birth with today's date.
        $now = new DateTime();

        //Calculate the time difference between the two dates.
        $difference = $now->diff($dob);

        //Get the difference in years, as we are looking for the user's age.
        $age = $difference->y;

      $provider = Yii::$app->user->identity->provider;
      $providerid = Yii::$app->user->identity->provider->provider_id;

        $selected = new SelectedSeeker();

     //   $selected = $selected->getSelected_seeker($providerid,$model->seeker_id);

      //  $status = $selected->getSelected_seeker($providerid,$model->seeker_id)->status;
        ?>

    <div class="col-md-4 col-sm-6  ">

        <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">
    </div>
        <div class="col-md-8 col-sm-6 ">
            <h3><?=$model->firstname?> <?=$model->lastname?>, <b><?=strtoupper(substr($model->gender,0,1))?>,<?=$age?>



                </b></h3>
            <?php
        if($selected->getSelected_seeker($providerid,$model->seeker_id) != null){
        ?>
                <?= $selected->status ?>
            <?php
            }
            ?>

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

            if($selected->selected($providerid,$model->seeker_id)) {

              $provider_job_id = $selected->getSelected_seeker($providerid,
                  $model->seeker_id)->provider_job_id;


                  ?>

                <a type="button" class="btn mybtndanger"
                   href="<?= Url::to(['provider/unselectseeker', 'seekerid' => $model->seeker_id,
                       'providerid' => $providerid,
                       'provider_job_id'=> $provider_job_id,
                       'nmb'=>5
                       ]) ?>"
                >
                    <i class="fa fa-window-close"></i>
                    Cancel
                </a>
                <?php


            }else {

                if ($provider_job->checkjobs($jobtypeid)->count() == 0 ) {

                    ?>

                    <?php Modal::begin([
                            'header'=>'<h4 class="text-center"><i class="fa fa-exclamation-triangle text-warning"></i> Cannot Select!</h4>' ,

                                'toggleButton'=>[
                               'tag'=>'a',
                            'label'=>'
                        <i class="far fa-check-circle"></i>
                      Select
                   ',
                            'class'=>'btn mybtnprimary'
                        ]
                    ]);?>
                   <div class="modal-body text-center">
                       You do not yet have any offer of "<b><?=$jobtype->getJobType($jobtypeid)->title?>(s)</b>"
                       or is already closed
                       <p><a href="<?=Url::to(['/provider/providerjobs'])?>"> Create Offer here or Reopen existing one</a></p>
                   </div>

                    <div class="modal-footer">
                        <a type="button" class="btn mybtndanger" href="" data-dismiss="modal">Cancel</a>
                    </div>
                    <?php
                    Modal::end();
                    ?>

                    <?php
                } else {

                    ?>
                    <div class="dropdown div-inline">
                    <a type="button" class="btn mybtnprimary dropdown-toggle"
                            href="" data-toggle="dropdown" >

                        <i class="far fa-check-circle"></i>
                        Select
                    </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-header">Select For:</a></li>
                        <?php
                        foreach($provider_job->checkjobs($jobtypeid)->all() as $jobs) {

                            ?>
                            <li> <a href="<?= Url::to(['provider/selectseeker',
                                    'seekerid' => $model->seeker_id,
                                    'providerid' => $providerid,
                                    'jobtypeid' => $jobs->job_type_id,
                                    'projobid'=>$jobs->provider_job_id])?>">
                                    <i class="fa fa-check-circle text-success"></i> <?=$jobs->job_title?> </a></li>

                            <?php
                        }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>



            <?php
            Modal::begin([
                'header' => '<h2>'. $model->firstname.' '.$model->lastname .'</h2>',
                'toggleButton' => ['label' => '<i class="far fa-user"></i> Profile','id'=>'profile','class'=>'btn mybtnsuccess'],


            ]);

            ?>



                <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">


                <h3> <b><?=strtoupper(substr($model->gender,0,1))?>, <?=$age?>

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

                <a href="<?=Url::to(['provider/unbookmarkseeker',
                    'provider_id'=>$providerid,
                    'seeker_id'=>$model->seeker_id,
                    'address'=>$address,
                    'jobtypeid'=>$jobtypeid,
                    'min_age'=>$min_age,
                    'max_age'=>$max_age,
                    'gender'=>$gender
                    ])?>"
                   class="bookmark_icon"><i class="fa fa-bookmark fa-2x mytext-right myfavoriteyes bookmarked">
                    </i></a>

                <?php
            }else {

                ?>

                <a href="<?= Url::to(['provider/bookmarkseeker',

                        'provider_id' => $providerid,
                        'seeker_id' => $model->seeker_id,
                    'address'=>$address,
                    'jobtypeid'=>$jobtypeid,
                    'min_age'=>$min_age,
                    'max_age'=>$max_age,
                    'gender'=>$gender

                    ]) ?>" class="bookmark_icon"><i class="far fa-bookmark fa-2x mytext-right myfavoriteyes ">
                    </i></a>
                <?php
            }

            ?>

            <?php Pjax::end();?>



</div>
    </div>
</div>



