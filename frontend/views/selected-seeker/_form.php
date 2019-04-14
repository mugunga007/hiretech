<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SelectedSeeker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="selected-seeker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'search_id')->textInput() ?>

    <?= $form->field($model, 'seeker_id')->textInput() ?>

    <?= $form->field($model, 'provider_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'selection_time')->textInput() ?>

    <?= $form->field($model, 'availability_time')->textInput() ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirmation_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
