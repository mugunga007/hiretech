<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderJobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'provider_job_id') ?>

    <?= $form->field($model, 'provider_id') ?>

    <?= $form->field($model, 'job_title') ?>

    <?= $form->field($model, 'job_type_id') ?>

    <?= $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'salary') ?>

    <?php // echo $form->field($model, 'work_hours') ?>

    <?php // echo $form->field($model, 'contract_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
