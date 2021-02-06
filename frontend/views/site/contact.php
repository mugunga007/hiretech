<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row ">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">

        <div class="page-header text-center">
            <h1> <i class="fa fa-edit"></i> </h1>


    <p>
        Want to contact <b>HireTech</b>?,
        Don't hesitate to write to us, We will get back to you as soon as possible.
    </p>
        </div>
    </div>

    <div class="col-md-4">
    </div>
</div>

    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div data-aos="fade-left">
                <div class="myform">
                    <div class="well well-sm text-center titlecolor">
                        <i class="fa fa-envelope-open-text"></i> Contact us </div>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>



                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
        </div>
    </div>



