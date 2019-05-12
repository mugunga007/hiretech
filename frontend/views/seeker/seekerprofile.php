<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/06
 * Time: 0:24
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
?>


        <?=$this->render('seekerdashlayout')?>



<div class="row">
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


   <div class="seekerprofile">
    <div class="row">
        <div class="col-sm-4 ">

           <img src="<?=Url::to(['img/upload/'.$model->picture])?>" class="img-responsive" width="150px">

            <?php Modal::begin([
                    'header'=>'<h3 class="text-center">Upload New Picture</h3>',
                    'toggleButton'=>[
                            'tag'=>'a',


                            'label'=>'<i class="fa fa-image"></i> Edit Image',
                        'class'=>'btn btn-link somespace'
                        ]
                ])
                ?>

            <?php $form = ActiveForm::begin([
                'action'=>'updatepicture',

                'options'=>['enctype'=>'multipart/form-data']]); ?>

            <?= $form->field($update_picture_model, 'picture')->fileInput() ?>


            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn mybtnprimary']) ?>
            </div>
            <?php ActiveForm::end(); ?>


            <?php
            Modal::end();
            ?>




        </div>

        <div class="col-md-8">
            <h5><b><i class="fa fa-user"></i> Firstname:</b> <?=$model->firstname?></h5>
            <h5><b><i class="fa fa-user"></i> Lastname:</b> <?=$model->lastname?></h5>
            <h5><b><i class="fa fa-info"></i> Gender:</b><?=ucfirst($model->gender)?></h5>
             <h5><b><i class="fa fa-birthday-cake"></i> Date Of Birth:</b> <?=$model->dob?></h5>
             <h5><b><i class="fa fa-map-marker"></i> Address</b> <?=$model->address?></h5>

           <h5><i class="fa fa-briefcase"></i> <b>Job Type:</b>
               <?php
               $seekerjobtypes = $model->seekerJobTypes;
               foreach($seekerjobtypes as $jobtypes){
                   ?>
                   <i class="fa fa-check-circle"> </i><?=$jobtypes->jobType->title?>
                   <?php
               }
               ?>
               <a href="<?=Url::to('updatejobtypes')?>" class=" text-center"> <i class="fa fa-briefcase"></i> Edit Your Skills</a>

           </h5>
           <h5><i class="fa fa-user-graduate"></i> <b>Experience:</b> <?=$model->experience?> </h5>

            <a href="<?=Url::to(['myupdate',

                'seeker_id'=>Yii::$app->user->identity->seeker->seeker_id
            ])
            ?>"
               class="btn mybtnprimary text-center"> <i class="fa fa-user-edit"></i> Edit Profile Info</a>

</div>
   </div>
    </div>


</div>


    <div class="col-md-2">
    </div>
</div>
</div>
