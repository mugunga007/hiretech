<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/02/08
 * Time: 20:53
 */
/* @var $model frontend\controllers\ProviderController */
use yii\helpers\Url;
use frontend\models\SelectedSeeker;
use frontend\models\ProviderJob;
use yii\bootstrap\Modal;
?>

<?php
$selectedSeeker = new SelectedSeeker();
$provider_job = new ProviderJob();
$candidates = $selectedSeeker->numberOfCandidatesByJob($model->provider_job_id);
$provider_job_id = $model->provider_job_id;
?>

<div class="col-md-4">

<div class="panel panel-default mine">
<div class="panel-heading text-center">
    <h5> <b><i class="fa fa-user-tie"> </i> <?=$model->job_title?>
        <?php
        $sn = $model->status;
        if($sn == 1) {
            ?>
            <i class="fa fa-spinner fa-spin text-center"> </i>

            <?php
        }elseif($sn == 3) {
            ?>
            <i class="fa fa-check-circle text-center text-success"> </i>

            <?php
        }
        ?>
        </b></h5>
</div>
    <div class="panel-body">
        <p> <b><i class="fa fa-user-tie"> </i> Position:</b> <?=$model->jobType->title?></p>
        <p><b><i class="fa fa-map-marker-alt"> </i> Location:</b> <?=$model->location?></p>
        <p><b><i class="fa fa-hand-holding-usd"> </i> Salary:</b> <?=$model->salary?></p>

                <?php



                /**
                 * Case 1: When 0 candidates are selected
                 * Case 2: When candidates are selected and offer not yet confirmed
                 * Case 3: When the offer has been confirmed
                 */

            $btn = '';
               $status = '';
               $case = 0;
                if($candidates == 0) {
                    $case = 1;
                    $btn = 'Add Candidates';
                    $status = 'No Candidates Selected';
                } elseif($candidates > 0 && ($sn <3)) {
                    $case = 2;
                    $status = 'Your Confirmation pending...';
                    $btn = 'Confirm offer';
                } else {
                    $case = 3;

                    $status = 'Candidates contacted (<b>'.$selectedSeeker->numberOfAcceptedCandidates($provider_job_id).'/'.$candidates.' </b> Accepted)';
                    $btn = 'Done';
                }
                    ?>


        <?php
                if ($case == 1){
        ?>
                    <div class="text-center">
        <p class="alert alert-danger text-center"><b><i class="fa fa-calendar"> </i>

            </b> <em><?=$status?></em> </p>
        <p><a href="<?=Url::to(['provider/searchjobcandidatespage',
                            'provider_job_id'=>$provider_job_id,
                           'job_type_id'=>$model->jobType->job_type_id
            ])
            ?>"
              class="btn btn-primary ">
                            <i class="fa fa-plus-circle"> </i> Add Candidates (<b><?=$candidates?></b>)</a></p>
                    </div>
                    <?php
                }elseif($case == 2) {
                    ?>
    <div class="text-center">
                    <p class="alert alert-warning text-center"><b><i class="fa fa-business-time"> </i>

                        </b> <em><?=$status?></em></p> </p>

        <p><a href="<?=Url::to(['provider/candidatesbyjob',
                'provider_job_id'=>$provider_job_id])?>"
              class="btn btn-primary"> <i class="fa fa-edit"> </i> Add/Confirm Candidates (<b><?=$candidates?></b>)</a></p>
    </div>
                    <?php
                }else{
        ?>
    <div class="text-center">
                    <p class="alert alert-success text-center"><b><i class="fa fa-calendar-check"> </i>

                        </b> <em><?=$status?></em> </>
        <p><a href="<?=Url::to(['provider/confirmedseekerbyjob',
                            'provider_job_id'=>$provider_job_id])?>"
              class="btn btn-primary"> <i class="fa fa-users"> </i> Candidates (<b><?=$candidates?></b>)</a>
            <?php
            $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
            if($provider_job->reopenable($provider_job_id)) {
                ?>
                <a href="<?= Url::to(['provider-job/reopen',
                    'provider_job_id' => $provider_job_id,

                    ]) ?>"
                   class="btn btn-warning"> <i class="fa fa-redo"> </i> Reopen Offer </a>
                <?php
            }
            ?>
        </p>
    </div>
        <?php
        }
        ?>
    </div>
<div class="panel-footer text-right">
    <a class="btn btn-default" href="#"><i class="fa fa-edit text-success"></i></a>

    <?php
    Modal::begin([

        'header' => '<h4> Delete Offer</h4>',
        'toggleButton' => ['label' =>'<i class="far fa-trash-alt text-danger"> </i>  ','class'=>'btn btn-default'],
        'footer'=> '<a href="" class="btn btn-danger"
                                        data-dismiss="modal"><i class="far fa-window-close"></i>
                                        Cancel</a>
                                        
                                         <a href="'.Url::to(['/provider/deleteproviderjob','provider_job_id'=>$model->provider_job_id]).'" class="btn btn-success">
                                        <i class="far fa-check-circle"></i>
                                        Ok</a>'

    ]);


    ?>
    <p>Are you sure you want to delete this offer with all information related to it?</p>


    <?php
    Modal::end();
    ?>
    <a  href="#" class="linktext "><i class="fa fa-clock"></i> <small><em>Added: <b><?=$provider_job->time_elapsed_string($model->date)?></b></em></small></a>


</div>

</div>

</div>