<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/08/15
 * Time: 12:06
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>


<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div data-aos="fade-left">
        <div class="myform">
            <div class="well well-sm text-center titlecolor"> Jobseeker Login  </div>

            <?php $form = ActiveForm::begin([

            ]); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
