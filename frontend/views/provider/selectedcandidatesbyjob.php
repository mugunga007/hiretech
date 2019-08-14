<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/28
 * Time: 13:44
 */

use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


?>
<?php
$provider_id = Yii::$app->user->identity->provider->provider_id;
?>
<div class="container">




            <?=$this->render('prodashlayout')?>

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="well well-sm titlecolor"><i class="fa fa-clipboard-check"></i> Sending Offer to the list of candidates you've chosen </div>


            <?php

            echo ListView::widget([
                'dataProvider'=>$selectedlist,
                'itemView'=>'/seeker/_selectedseeker',
                'emptyText'=>'No Selected Candidates yet!',
                'viewParams'=>[
                        'provider_job_id'=>$provider_job_id
                    ]

            ])

            ?>
            <a href="<?=Url::to(['provider/searchjobcandidates','provider_job_id'=>$provider_job_id,'job_type_id'=>$job_type_id])?>"
               style="text-decoration: none">
            <div class="selectedlist text-center">
                <i class="fa fa-user-plus fa-3x text-success"></i>
                <p>Add more Candidates to this offer</p>
            </div>
            </a>
            <hr/>



            <?php $form = ActiveForm::begin([
                'action'=>'confirmoffer',
                'method'=>'post',
            ]) ?>
            <?=$form->field($model,'message')->textarea()->label('Message to Candidates <em><small style="font-weight:normal;"> (optional)</small></em> ')?>
            <?=$form->field($model, 'provider_id')->hiddenInput(['value'=>$provider_id])->label(false)?>
            <?=$form->field($model, 'provider_job_id')->hiddenInput(['value'=>$provider_job_id])->label(false)?>


            <div class="text-center">
                <button class="btn  mybtnprimary"><i class="far fa-check-circle"></i> Send offer to Candidates </button>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>

</div>
