<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/03/14
 * Time: 23:14
 */

use frontend\models\SelectedSeeker;
use yii\bootstrap\Modal;
use frontend\models\Seeker;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use frontend\models\ProviderJob;
?>
<?php

?>

<?php
$selected_seeker = new SelectedSeeker();
 $id = $model->provider_job_id
?>
<div class="row rowend">

    <div class="row text-center ">
        <h3> <i class="fa fa-briefcase"></i>   <?=$model->job_title?></h3>

    </div>
    <div class="col-sm-3 text-center ">
           <a href="" class="" data-toggle="modal" data-target="#selected">
        <div class="dashdiv ">


            <i class="fa fa-users fa-2x  "></i>
            <p> <small >Candidates</small></p>
            <h4><b><?=$selected_seeker->numberOfCandidatesByJob($model->provider_job_id)?></b></h4>


        </div>
        </a>
    </div>


<!-- Availabe  -->

    <div class="col-sm-3 text-center ">
        <?php Modal::begin([
                'header'=>'<h4 class="text-success"> Available</h4>',

            'toggleButton'=>[
                'tag'=>'a',
                'label'=>'<div class="dashdiv " style="cursor: pointer">
            <i class="fa fa-user-check fa-2x  text-success"></i>
            <p class="text-success"> <small >Available Now</small></p>
            <h4 class="text-success"><b>'.$selected_seeker->numberOfAcceptedCandidates($model->provider_job_id).'</b></h4>
        </div>'
        ]
        ])
        ?>

        <div class="modal-body">

        <?php
        //  $acce = new Seeker();
        $accepted_seekers = $selected_seeker->acceptedCandidates($model->provider_job_id);

        if($selected_seeker->numberOfAcceptedCandidates($model->provider_job_id)==0){

            ?>

            No Candidates to Show

            <?php
        }else {

            foreach ($accepted_seekers as $accepted) {


                ?>

                <div class="row">
                    <?php

                    //Create a DateTime object using the user's date of birth.
                    $dob = new DateTime($accepted->seeker->dob);

                    //We need to compare the user's date of birth with today's date.
                    $now = new DateTime();

                    //Calculate the time difference between the two dates.
                    $difference = $now->diff($dob);

                    //Get the difference in years, as we are looking for the user's age.
                    $age = $difference->y;

                    //  $providerid = Yii::$app->user->identity->provider->provider_id;

                    ?>

                    <div class="col-md-4 col-sm-6  ">
                        <img src="<?= Url::to(['img/upload/' . $accepted->seeker->picture]) ?>"
                             class="img-responsive"
                             width="150px">
                    </div>
                    <div class="col-md-8 col-sm-6 ">
                        <h3><b><?= ucfirst($accepted->seeker->firstname) ?> <?= ucfirst($accepted->seeker->lastname) ?></b>,
                            <b><?= strtoupper(substr($accepted->seeker->gender, 0, 1)) ?>,<?= $age ?>
                                <?php
                                // date_diff(date_create($dob),date_create($today))->format('%Y')
                                ?>
                            </b></h3>
                        <h5><i class="fa fa-map-marker-alt"> </i> Location: <?= $accepted->seeker->address ?></h5>
                        <h5><i class="fa fa-phone"> </i> Phone: <?= $accepted->seeker->phone ?></h5>
                        <h5><i class="fa fa-envelope"> </i> Email: <?= $accepted->seeker->email ?></h5>

                        <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
                            <?php
                            $seekerjobtypes = $accepted->seeker->seekerJobTypes;
                            foreach ($seekerjobtypes as $jobtypes) {
                                ?>
                                <i class="far fa-check-circle"> </i><?= $jobtypes->jobType->title ?>
                                <?php
                            }

                            ?>
                        </h5>
                        <h5><i class="fa fa-user-graduate"></i>
                            <b>Experience:</b> <?= $accepted->seeker->experience ?> </h5>
                        <hr>
                    </div>


                </div>
                <?php
            }
        }
        ?>

        </div>
        <?php Modal::end();
        ?>
    </div>
<!-- Availabe  -->

    <!-- Not Availabe -->
    <div class="col-sm-3 text-center ">

        <?php Modal::begin([
                'header'=>'<h4 class="text-danger"> Not Available</h4>',

            'toggleButton'=>[
                'tag'=>'a',
                'label'=>'<div class="dashdiv" style="cursor: pointer;">
            <i class="fa fa-user-times fa-2x text-danger "></i>
            <p class="text-danger"> <small >Not Available</small></p>
            <h4 class="text-danger"><b>'.$selected_seeker->numberOfDeniedCandidates($model->provider_job_id).'</b></h4>
        </div>'
            ]
])
?>

        <?php
        //  $acce = new Seeker();
        $denied_seekers = $selected_seeker->deniedCandidates($model->provider_job_id);

        if($selected_seeker->numberOfDeniedCandidates($model->provider_job_id)==0){

            ?>

            No Candidates to Show

            <?php
        }else {
            foreach ($denied_seekers as $denied) {


                ?>
                <div class="row rowend">
                    <?php

                    //Create a DateTime object using the user's date of birth.
                    $dob = new DateTime($denied->seeker->dob);

                    //We need to compare the user's date of birth with today's date.
                    $now = new DateTime();

                    //Calculate the time difference between the two dates.
                    $difference = $now->diff($dob);

                    //Get the difference in years, as we are looking for the user's age.
                    $age = $difference->y;

                    //  $providerid = Yii::$app->user->identity->provider->provider_id;

                    ?>

                    <div class="col-md-4 col-sm-6  ">
                        <img src="<?= Url::to(['img/upload/' . $denied->seeker->picture]) ?>"
                             class="img-responsive" width="150px">

                    </div>
                    <div class="col-md-8 col-sm-6 ">
                        <h3><?=ucfirst($denied->seeker->firstname)?> <?=ucfirst($denied->seeker->lastname)?>,
                            <b><?= strtoupper(substr($denied->seeker->gender, 0, 1)) ?>,<?= $age ?>
                                <?php
                                // date_diff(date_create($dob),date_create($today))->format('%Y')
                                ?>
                            </b></h3>
                        <p><i class="fa fa-map-marker-alt"> </i> <?= $denied->seeker->address ?></p>
                        <h5><i class="fa fa-phone"> </i> Phone: <em>Not available</em></h5>
                        <h5><i class="fa fa-envelope"> </i> Email: <em>Not available</em></h5>
                        <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
                            <?php
                            $seekerjobtypes = $denied->seeker->seekerJobTypes;
                            foreach ($seekerjobtypes as $jobtypes) {
                                ?>
                                <i class="far fa-check-circle"> </i><?= $jobtypes->jobType->title ?>
                                <?php
                            }
                            ?>
                        </h5>
                        <h5><i class="fa fa-user-graduate"></i>
                            <b>Experience:</b> <?= $denied->seeker->experience ?> </h5>
                        <hr>
                    </div>


                </div>
                <?php
            }

        }
        ?>

        <?php Modal::end();?>
    </div>
    <!-- Not Availabe -->

    <!-- No feedback Yet -->

    <div class="col-sm-3 text-center ">
        <?php Modal::begin([
            'header'=>'<h4 class="text-warning"> No Feedback Yet</h4>',

            'toggleButton'=>[
                'tag'=>'a',
                'label'=>'<div class="dashdiv" style="cursor: pointer;">
            <i class="fa fa-user-clock fa-2x text-warning "></i>
            <p class="text-warning"> <small >No Feedback Yet</small></p>
            <h4 class="text-warning"><b>'.$selected_seeker->numberOfNoFeedbackCandidates($model->provider_job_id).'</b></h4>
        </div>'
        ]
        ])
        ?>

        <?php
        //  $acce = new Seeker();
        $nofeedbackyet_seekers = $selected_seeker->nofeedbackyetCandidates($model->provider_job_id);

        if($selected_seeker->numberOfNoFeedbackCandidates($model->provider_job_id)==0){

            ?>

            No Candidates to Show

            <?php
        }else {
            foreach ($nofeedbackyet_seekers as $nofeedbackyet) {


                ?>
                <div class="row rowend">
                    <?php

                    //Create a DateTime object using the user's date of birth.
                    $dob = new DateTime($nofeedbackyet->seeker->dob);

                    //We need to compare the user's date of birth with today's date.
                    $now = new DateTime();

                    //Calculate the time difference between the two dates.
                    $difference = $now->diff($dob);

                    //Get the difference in years, as we are looking for the user's age.
                    $age = $difference->y;

                    //  $providerid = Yii::$app->user->identity->provider->provider_id;

                    ?>

                    <div class="col-md-4 col-sm-6  ">
                        <img src="<?= Url::to(['img/upload/' . $nofeedbackyet->seeker->picture]) ?>"
                             class="img-responsive" width="150px">

                    </div>
                    <div class="col-md-8 col-sm-6 ">
                        <h3><?=ucfirst($nofeedbackyet->seeker->firstname)?> <?=ucfirst($nofeedbackyet->seeker->lastname)?>,
                            <b><?= strtoupper(substr($nofeedbackyet->seeker->gender, 0, 1)) ?>,<?= $age ?>
                                <?php
                                // date_diff(date_create($dob),date_create($today))->format('%Y')
                                ?>
                            </b></h3>
                        <p><i class="fa fa-map-marker-alt"> </i> <?= $nofeedbackyet->seeker->address ?></p>
                        <h5><i class="fa fa-phone"> </i> Phone: <em>No feedback yet</em></h5>
                        <h5><i class="fa fa-envelope"> </i> Email: <em>No feedback yet</em></h5>
                        <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
                            <?php
                            $seekerjobtypes = $nofeedbackyet->seeker->seekerJobTypes;
                            foreach ($seekerjobtypes as $jobtypes) {
                                ?>
                                <i class="far fa-check-circle"> </i><?= $jobtypes->jobType->title ?>
                                <?php
                            }
                            ?>
                        </h5>
                        <h5><i class="fa fa-user-graduate"></i>
                            <b>Experience:</b> <?= $nofeedbackyet->seeker->experience ?> </h5>
                    <hr>
                    </div>


                </div>
                <?php
            }
        }
        ?>

        <?php Modal::end();?>

    </div>

    <!-- No feedback Yet -->

</div>

<!-- Testing  -->



<!-- Testing  -->

