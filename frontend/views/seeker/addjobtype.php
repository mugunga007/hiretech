<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2018/12/28
 * Time: 2:57
 */

use frontend\models\JobType;
use frontend\models\Seeker;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php




?>

    <div class="well well-sm text-center"> Step 1-2: Add Job Skills </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-6">


                <div class="myform">

                    <h3><?=ucfirst(Yii::$app->user->identity->seeker->firstname) ?>'s job skills (<?=count(Yii::$app->user->identity->seeker->seekerJobTypes) ?>) </h3>
                    <?php
                    foreach ($seekerjobtypes as $types) {
                        ?>
                        <div class="btn-group">
                        <a type="button" class="btn btn-success"> <?=$types->jobType->title?> <i class="far fa-check-circle "></i></a>

                        <?=Html::a('<i class="fa fa-trash-alt "></i>',['/seeker/deletejob','id'=>$types->id],[
                                'class'=>'btn btn-danger',
                                'title'=>'Remove this job',
                                'data'=>[
                                        'confirm'=>'Are you sure you want to remove this job type?',
                                        'method'=>'post'
                                ]
                        ])?>
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
                        <a type="button" href="<?=Url::to(['seeker/addjobtype','seekerid'=>Yii::$app->user->identity->seeker->seeker_id,'jobtypeid'=>$jobtype->job_type_id])?>" class="btn btn-primary somespace"> <i
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

</div>

