<?php
/**
 *
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/02/25
 * Time: 0:09
 *
 * @var $model frontend\controllers\SeekerController
 */

use frontend\models\ProviderJob;
use frontend\models\JobType;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php

$provider_job = new ProviderJob();
$provider_job = ProviderJob::findOne(['provider_job_id'=>$model->provider_job_id]);
$job_type = new JobType();
$job_type = JobType::findOne(['job_type_id'=>$provider_job->job_type_id]);

?>
<div class="col-md-4">
    <div class="panel panel-default mine">
        <div class="panel-heading text-center">
            <h3> <i class="fa fa-check-circle text-success"> </i> <?=$job_type->title?>



            </h3>
        </div>
        <div class="panel-body">
            <p> <b><i class="fa fa-user-tie"> </i> Position:</b> <?=$provider_job->job_title?></p>
            <p><b><i class="fa fa-map-marker-alt"> </i> Location:</b> <?=$provider_job->location?></p>
            <p><b><i class="fa fa-hand-holding-usd"> </i> Salary:</b> <?=$provider_job->salary?></p>
            <p><b><i class="fa fa-calendar-alt"> </i> Date:</b> <?=date("Y-m-d", strtotime($model->confirmation_time)) ?></p>




                <?php
                Modal::begin([

                    'header' => '<h4> Deny offer</h4>',
                    'toggleButton' => ['label' =>'<i class="far fa-thumbs-down"> </i> Deny  ','class'=>'btn mybtndanger'],
                    'footer'=> '<a href="" class="btn btn-danger"
                                        data-dismiss="modal"><i class="far fa-window-close"></i>
                                        Cancel</a>
                                        
                                         <a href="'.Url::to(['seekerdenyoffer','selected_seeker_id'=>$model->selected_seeker_id]).'" class="btn btn-success" 
                                         >
                                        <i class="far fa-check-circle"></i>
                                        Ok</a>'

                ]);


                ?>


            <p>If you deny the offer, the employer will not be able to contact you.</p>

            <h5>Do you want to proceed?</h5>
            <?php
            Modal::end();
            ?>

            <!-- ************* ********************************************** -->

                    <?php
                    Modal::begin([

                        'header' => '<h4> Accept offer</h4>',
                        'toggleButton' => ['label' =>'<i class="far fa-handshake"> </i> Accept  ','class'=>'btn mybtnsuccess'],
                        'footer'=> '<a href="" class="btn btn-danger"
                                        data-dismiss="modal"><i class="far fa-window-close"></i>
                                        Cancel</a>
                                        
                                         <a href="'.Url::to(['seekeracceptoffer','selected_seeker_id'=>$model->selected_seeker_id]).'" class="btn btn-success">
                                        <i class="far fa-check-circle"></i>
                                        Ok</a>'

                    ]);


                    ?>
            <p>Acceting offer will disclose you contact information to the employer so
                he can contact you.</p>

            <h5>Do you want to proceed?</h5>
                     <?php
                     Modal::end();
                     ?>



        </div>

    </div>

</div>




