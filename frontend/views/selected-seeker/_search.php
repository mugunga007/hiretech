<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SelectedSeekerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="selected-seeker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'selected_seeker_id') ?>

    <?= $form->field($model, 'search_id') ?>

    <?= $form->field($model, 'seeker_id') ?>

    <?= $form->field($model, 'provider_id') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'selection_time') ?>

    <?php // echo $form->field($model, 'availability_time') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'job_description') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'confirmation_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
