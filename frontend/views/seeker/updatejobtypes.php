<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/05
 * Time: 11:49
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;


?>

<?=$this->render('seekerdashlayout')?>



<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">


        <div class="myform">
<div class="well well-sm text-center titlecolor"> Update Job Skills </div>

            <h3><?=ucfirst(Yii::$app->user->identity->seeker->firstname) ?>'s job skills (<?=count(Yii::$app->user->identity->seeker->seekerJobTypes) ?>) </h3>
            <?php
            foreach ($seekerjobtypes as $types) {
                ?>
                <div class="btn-group">
                    <a type="button" class="btn btn-success"> <?=$types->jobType->title?> <i class="far fa-check-circle "></i></a>



                    <?php
                    Modal::begin([

                        'header' => '<h4> Remove Skill</h4>',
                        'toggleButton' => ['label' =>'<i class="far fa-trash-alt"> </i>  ','class'=>'btn btn-danger'],
                        'footer'=> '<a href="" class="btn btn-danger"
                                        data-dismiss="modal"><i class="far fa-window-close"></i>
                                        Cancel</a>
                                        
                                         <a href="'.Url::to(['/seeker/deletejob','id'=>$types->id]).'" class="btn btn-success">
                                        <i class="far fa-check-circle"></i>
                                        Ok</a>'

                    ]);


                    ?>
                    <p>Are you sure you want to Remove this from your skills?</p>


                    <?php
                    Modal::end();
                    ?>
                </div>
                <br/>
                <br/>
                <?php
            }
            ?>
            <hr>

            You can add more skills below
            <hr>
            <?php
            foreach ($job as $jobtype) {
                ?>
                <a type="button" href="<?=Url::to(['seeker/updatejobtypessubmit','seekerid'=>Yii::$app->user->identity->seeker->seeker_id,'jobtypeid'=>$jobtype->job_type_id])?>"
                   class="btn btn-primary somespace"> <i
                        class="fa fa-plus"></i> <?=$jobtype->title ?> </a>
                <?php
            }
            ?>
            <hr>
            <div class="text-center">
                <a type="button" class="btn mybtnsuccess" href="<?=Url::to(['seeker/seekerprofile'])?>"> Finish Registration <i class="far fa-check-square"></i> </a>
            </div>
        </div>

    </div>

    <div class="col-md-2">
    </div>

</div>


</div>