<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model frontend\models\Provider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-form">
    <div class="well well-sm text-center titlecolor"><i class="fa fa-user"></i> Register as employer </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'names')->textInput(['maxlength' => true])->input('text',['placeholder'=>'Enter full names'])?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->input('text',['placeholder'=>'Your contact email']) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model,'password_repeat')->passwordInput(['maxlenght'=>true])->label('Confirm Password')?>
    <?php

    $array = [
        ['id' => 'individual', 'name' => 'Individual'],
        ['id' => 'company', 'name' => 'Company'],
    ];
    $data = ArrayHelper::map($array,'id','name');
    ?>
    <?= $form->field($model, 'type')->dropDownList(
        $data,
        ['prompt'=>'Select']
    )?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput()->input('text',['placeholder'=>'eg: 0788102030']) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
