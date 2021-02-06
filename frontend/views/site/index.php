<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>




    <div class="row">

        <div class="col-md-8 ">

            <div class="animated fadeInLeft">
                <div class="homepagead">

                    <div class=" text-center">
                        <div class="row">
                            <img src="<?=Url::to(['img/animefastcl.gif'])?>" width="50%" />


                            <h3>Are you looking for the <em class="mycolor">right</em> employee?</h3>
                            <h3>Are you looking for the <em class="mycolor">right</em> job? </h3>

                            <em>You're at the <em class="mycolor">right</em> place. Register with us and open the <em class="mycolor">right</em> doors!</em>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a type="button" href="<?=Url::to(['seeker/create'])?>"
                                   class="btn btn-lg mybtnprimary">Searching for a job.
                                    </a>
                            </div>

                            <div class="col-sm-6 ">
                                <a type="button" href="<?=Url::to(['provider/create'])?>"
                                   class="btn btn-lg mybtnprimary">Looking for an employee.
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-4  ">

            <div class="animated fadeInRight">
                <div class="myform">
                    <div class="well well-sm text-center "> Already Registered? Sign in </div>



                    <a type="button" href="<?=Url::to(['seeker/login'])?>"
                       class="btn btn-lg mybtnprimary">
                        <i class="fa fa-user"></i>
                        Job Seeker
                        </a>



                    <a type="button" id="element"  href="<?=Url::to(['provider/login'])?>"
                       class="btn btn-lg mybtnprimary">
                        <i class="fa fa-user"></i>
                        Employer
                    </a>


                </div>
            </div>
        </div>


    </div>


<div class="row">
    <div class="page-header text-center">
        <div class="animated fadeInUp">
            <h2><i class="fa fa-hands-helping"></i></h2>
            <h1 class="">Our Services </h1>



        </div>
    </div>
</div>

        <div class="row">
            <div class="col-lg-4 text-center">
                <div data-aos="fade-right">
                    <h2><i class="fa fa-user-tie fa-2x"></i></h2>
                    <h4><b>Find Employees Fast</b></h4>
                    <p>With various search options, you get to choose employees you're looking for like never before.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">More &raquo;</a></p>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div data-aos="fade-up">
                <h2><i class="fa fa-sms fa-2x"></i></h2>
                    <h4><b>SMS Notifications</b></h4>
                <p>For faster reach out, we deliver your offer on Smart to feature phone via message or SMS.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">More &raquo;</a></p>
                </div>
                </div>
            <div class="col-lg-4 text-center">
                <div data-aos="fade-left">
                    <h2><i class="far fa-clock fa-2x"></i></h2>
                    <h4><b>We respect your time</b></h4>
                    <p>Our system will provide you trustful employee the next day.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">More &raquo;</a></p>
                </div>
            </div>
        </div>




