<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="container">

    <div class="row">

        <div class="col-md-8">
            <div class="animated fadeInLeft">
                <div class="homepagead">

                    <div class=" text-center">
                        <div class="row">
                        <img src="<?=Url::to(['img/animefastcl.gif'])?>" width="50%" />


                        <h3>Are you looking for the <em class="mycolor">right</em> employee?</h3>
                        <h3>Or are you searching for a job? </h3>

                        <em>You're at the <b class="mycolor">right</b> place, just register with us and open the <b class="mycolor">right</b> doors!</em>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                        <a type="button" href="<?=Url::to(['seeker/create'])?>" class="btn btn-lg mybtnprimary">I'm searching for a job <i class="fa fa-mouse-pointer "></i></a>
                            </div>

                            <div class="col-sm-6">
                        <a type="button" href="<?=Url::to(['provider/create'])?>" class="btn btn-lg mybtnprimary">I'm looking for an employee <i class="fa fa-mouse-pointer "></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="animated fadeInRight">
                <div class="myform">
                    <div class="well well-sm text-center titlecolor"> Already registered? Login here! </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput() ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="color:#999;margin:1em 0">
                        If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    </div>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary mybtn ', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>


    </div>



    <div class="jumbotron ">
        <div class="animated fadeInUp">
            <h1 class=""> Services</h1>

            <p class="lead">Meet the right people for you work.</p>

        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 text-center">
                <div data-aos="fade-right">
                    <h2><i class="fa fa-user-tie fa-2x"></i></h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">More &raquo;</a></p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div data-aos="fade-up">
                <h2><i class="fa fa-globe-africa fa-2x"></i></h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">More &raquo;</a></p>
                </div>
                </div>
            <div class="col-lg-4 text-center">
                <div data-aos="fade-left">
                    <h2><i class="far fa-clock fa-2x"></i></h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">More &raquo;</a></p>
                </div>
            </div>
        </div>

    </div>


</div>