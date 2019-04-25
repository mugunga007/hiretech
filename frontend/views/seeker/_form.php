<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\JobType;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Seeker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seeker-form">


    <div class="well well-sm text-center titlecolor"> Step 1-2: Basic Info </div>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true])->label('Confirm Password') ?>

    <?= $form->field($model, 'dob')->label('Date of Birth')->widget(DatePicker::className([
        'name' => 'check_issue_date',
        'value' => date('d-M-y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'dd-MM-yyyy',
            'todayHighlight' => true
        ]
    ]));?>



    <?= $form->field($model, 'gender')->radioList([
            'male'=>'Male',
            'female'=>'Female'
            ],
        ['prompt'=>'select','size'=>3]
        ) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture')->fileInput() ?>


    <?= $form->field($model, 'experience')->textarea(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'btn mybtnprimary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>







