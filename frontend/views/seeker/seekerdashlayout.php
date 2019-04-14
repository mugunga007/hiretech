<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/12
 * Time: 0:07
 */

//use yii\widgets\ActiveForm;
use frontend\models\JobType;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\models\SelectedSeeker;
use frontend\models\ProviderJob;

?>
<?php

?>

<div class="navpil " >
    <ul class="nav nav-justified">
        <li class="myactive ">
            <a href="<?=Url::to(['seeker/seekerdashboard'])?>"><i class="fa fa-home "></i> Dashboard  </a>
        </li>

        <li>
            <a href="<?=Url::to(['provider/providerjobgoto'])?>"><i class="fa fa-user-alt"></i> My Profile </a>
        </li>
        <li>
            <a href="<?=Url::to(['provider/prodashsearch'])?>"><i class="fa fa-briefcase"></i> My Jobs (2) </a>
        </li>





    </ul>
</div>

