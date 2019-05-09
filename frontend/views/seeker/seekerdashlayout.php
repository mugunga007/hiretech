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
use yii\widgets\Menu;
?>
<?php

?>
<div class="row">
    <div class="col-md-1">
    </div>

    <div class="col-md-10">
<div class="navpil " >
    <ul class="nav nav-justified">

        <?php
        echo Menu::widget([
            'items'=>[
                ['label'=>'Dashboard',
                    'url'=>['seeker/seekerdashboard'],
                    'template'=>' <a href="{url}"> <i class="fa fa-tachometer-alt"></i> {label} </a>'
                ],

                ['label'=>'My Profile',
                    'url'=>['seeker/myprofile'],
                    'template'=>' <a href="{url}"> <i class="fa fa-user-alt"></i> {label} </a>'
                ],

                ['label'=>'My Jobs',
                    'url'=>['seeker/seekeralloffers'],
                    'template'=>' <a href="{url}"> <i class="fa fa-briefcase"></i> {label} </a>'
                ],
],
            'activeCssClass'=>'myactive',
          'options' => [
            'class' => 'nav nav-justified',

            'style'=>'font-size: 14px;',
            'data-tag'=>'yii2-menu',
              ]

        ]);
        ?>





    </ul>
</div>
    </div>
    <div class="col-md-1">
    </div>
</div>
<hr>

