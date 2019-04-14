<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/06
 * Time: 0:24
 */

use yii\helpers\Url;
?>

    <div class="row">

        <div class=" col-md-2 ">
        </div>
        <div class=" col-md-6">
<div class="seekerprofile">
    <?php
    $today = date('Y-d-m');
    $dob = $model->dob;


    //Create a DateTime object using the user's date of birth.
    $dob = new DateTime($model->dob);

    //We need to compare the user's date of birth with today's date.
    $now = new DateTime();

    //Calculate the time difference between the two dates.
    $difference = $now->diff($dob);

    //Get the difference in years, as we are looking for the user's age.
    $age = $difference->y;
    ?>
            <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">
            <h3><?=$model->firstname?> <?=$model->lastname?>, <b><?=$model->gender?>, <?=$age?></b></h3>
            <p><i class="fa fa-map-marker-alt"> </i> <?=$model->address?></p>
            <h5><i class="fa fa-calendar-alt"> </i><b>age:</b> <?=$model->dob?></h5>
            <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
                <?php
                foreach($seekerjobtypes as $jobtypes){
                ?>
                    <i class="far fa-check-circle"> </i><?=$jobtypes->jobType->title?>
                <?php
                }
                ?>
            </h5>
            <h5><i class="fa fa-user-graduate"></i> <b>Experience:</b> <?=$model->experience?> </h5>
            <a type="button" class="btn mybtnprimary" href="<?=Url::to(['/seeker/update','id'=>$model->seeker_id])?>">Edit Profile <i class="far fa-edit"></i></a>

        </div>


    </div>
    <div class="col-md-2">
    </div>

</div>
