<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\JobType;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderJob */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-job-form">

    <div class="well well-sm text-center titlecolor"> Create Job Offer </div>

    <?php $form = ActiveForm::begin([
            'action'=>'providerjobcreate',
            'method'=>'get'
    ]); ?>

    <?php
    $jobtypes = JobType::find()->all();
    $listdata = ArrayHelper::map($jobtypes,'job_type_id','title');
    ?>
    <?= $form->field($model, 'job_type_id')->dropDownList(
            $listdata,[
            'prompt'=>'Select'
    ]) ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'salary')->textInput() ?>

    <?= $form->field($model, 'work_hours')->textInput() ?>
    <?php
    $contract =[
            ['id'=>'permanent', 'name'=>'Permanent'],
            ['id'=>'temporary', 'name'=>'Temporary'],
            ['id'=>'parttime', 'name'=>'Part Time'],
            ['id'=>'probation', 'name'=>'Probation'],

    ];
    $data = ArrayHelper::map($contract,'id','name');

    ?>
    <?= $form->field($model, 'contract_type')->dropDownList(
           $data,
           ['prompt'=>'Select']
    ) ?>

    <?=$form->
    field($model, 'round')->hiddenInput(['value'=>1])->label(false)?>


    <div class="form-group text-center ">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn mybtnsuccess']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
