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

<div class="container">


        <div class="row">
            <div class="col-md-2">
            <?=$this->render('prodashlayout');?>
            </div>



            <div class="col-md-8">
                <div class="well well-sm titlecolor"><i class="far fa-tasks"></i> Confirm the list of candidates you've chosen </div>



                <?php

                echo ListView::widget([
                        'dataProvider'=>$selectedlist,
                        'itemView'=>'/seeker/_selectedseeker',
                    'emptyText'=>'No Selected Candidates yet!',

                ])

                ?>
              <hr/>



                <?php $form = ActiveForm::begin([
                        'action'=>'confirmform',
                        'method'=>'post',
                ]) ?>
                <?=$form->field($model,'message')->textarea()?>
                <?=$form->field($model,'job_description')->textarea()?>
                <div class="text-center">
                    <button class="btn btn-lg mybtnprimary">Confirm <i class="far fa-check-circle"></i></button>
                </div>
            <?php ActiveForm::end() ?>
            </div>

        </div>

</div>
