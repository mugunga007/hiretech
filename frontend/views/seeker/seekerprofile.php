<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/06
 * Time: 0:24
 */

use yii\helpers\Url;
?>


        <?=$this->render('seekerdashlayout')?>


<div class="row">
    <div class="seekerprofile">
    <div class="col-md-2">
    </div>

    <div class="col-md-8">

    <?php

    //Create a DateTime object using the user's date of birth.
    $dob = new DateTime($model->dob);

    //We need to compare the user's date of birth with today's date.
    $now = new DateTime();

    //Calculate the time difference between the two dates.
    $difference = $now->diff($dob);

    //Get the difference in years, as we are looking for the user's age.
    $age = $difference->y;




    //   $selected = $selected->getSelected_seeker($providerid,$model->seeker_id);

    //  $status = $selected->getSelected_seeker($providerid,$model->seeker_id)->status;
    ?>

    <div class="col-md-4 col-sm-6  ">

        <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">
    </div>
    <div class="col-md-8 col-sm-6 ">
        <h3><?=$model->firstname?> <?=$model->lastname?>, <b><?=strtoupper(substr($model->gender,0,1))?>,<?=$age?>



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
           </div>



    </div>
    <div class="col-md-2">
    </div>
</div>
</div>
