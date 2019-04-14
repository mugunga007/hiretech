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



    <div class="row  ">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 ">
            <?=$this->render('prodashlayout')?>
        </div>
        <div class="col-md-1">
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="well well-sm titlecolor"><i class="far fa-tasks"></i> Confirm the list of candidates you've chosen </div>

            <div class="animated shake">
            <a class="btn mybtnsuccess"
               href="<?=Url::to(['provider/searchjobcandidates','provider_job_id'=>$provider_job_id,'job_type_id'=>$job_type_id])?>">

                <i class="fa fa-search fa-2x"></i>  Search For More Condidates

                </i>
            </a>
            </div>
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
            <hr/>



            <?php $form = ActiveForm::begin([
                'action'=>'confirmoffer',
                'method'=>'post',
            ]) ?>
            <?=$form->field($model,'message')->textarea()->label('Message to Candidates <em><small style="font-weight:normal;"> (optional)</small></em> ')?>
            <?=$form->field($model, 'provider_id')->hiddenInput(['value'=>$provider_id])->label(false)?>
            <?=$form->field($model, 'provider_job_id')->hiddenInput(['value'=>$provider_job_id])->label(false)?>


            <div class="text-center">
                <button class="btn  mybtnprimary"><i class="far fa-check-circle"> Send offer to Candidates </i></button>
            </div>
            <?php ActiveForm::end() ?>
        </div>

    </div>

</div>
