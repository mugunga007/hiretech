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

?>




<div class="selectedlist">


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

        ?>

        <div class="col-md-4 col-sm-6  ">
            <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">
        </div>
        <div class="col-md-8 col-sm-6 ">
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
                    <i class="far fa-check-circle"> </i><?=$jobtypes->jobType->title?>
                    <?php
                }
                ?>
            </h5>
            <h5><i class="fa fa-user-graduate"></i> <b>Experience:</b> <?=$model->experience?> </h5>
            <?php
            $selected = new SelectedSeeker();

                ?>
                <a type="button" class="btn mybtndanger"
                   href="<?= Url::to(['provider/unselectseeker', 'seekerid' => $model->seeker_id, 'providerid' => Yii::$app->user->identity->provider->provider_id,'provider_job_id'=>$provider_job_id]) ?>"
                >
                    Remove
                    <i class="far fa-window-close"></i></a>


            <?php
            Modal::begin([
                'header' => '<h2>'. $model->firstname.' '.$model->lastname .'</h2>',
                'toggleButton' => ['label' => 'View Profile','id'=>'profile','class'=>'btn mybtnsuccess'],


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



        </div>

    </div>
</div>



