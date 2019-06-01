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
use frontend\models\BookmarkSeeker;
use yii\widgets\Pjax;

?>
<?php
$provider_id = Yii::$app->user->identity->provider->provider_id;
$provider_job = new ProviderJob();
$session = Yii::$app->session;
$bookmark_seeker = new BookmarkSeeker();
?>



<div class="row navpil text-center" >

    <div class="col-md-12">



<nav class="navbar navbar-default ">
    <div class="navbar-header dashcollapse">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

        </button>

    </div>
<div class="collapse navbar-collapse" id="mynav">
    <?php
  echo  Menu::widget([
        'items'=>[
                ['label'=>' Dashboard',
                    'url'=>['provider/providerdashboard'],
                   'template'=>' <a href="{url}"> <i class="fa fa-tachometer-alt"></i> {label} </a>'
                    ],

            ['label'=>' My Offers ('.$provider_job->provider_jobs_number($provider_id).')',
                'url'=>['provider/providerjobgoto'],
                    'template'=>' <a href="{url}"><i class="fa fa-briefcase"></i>  {label} </a>'

                ],


            ['label'=>' Job Seekers',
                'url'=>['provider/prodashsearch'],
                'template'=>' <a href="{url}"> <i class="fa fa-search"></i> {label} </a>'
            ],




            ['label'=>' Saved Profiles',
                'url'=>['provider/bookmarkspage'],
                'template'=>' <a href="{url}"> <i class="fa fa-bookmark"></i> {label} ('.$bookmark_seeker->number_of_bookmarked($provider_id).') </a>'
            ],



        ],

            'activeCssClass'=>'myactive',
          'options' => [
              'class' => 'nav  nav-justified ',
                'id'=>'mynav',

              'style'=>'font-size: 14px;',
              'data-tag'=>'yii2-menu',
          ],
        ]
    )
    ?>
</div>
</nav>
    </div>

</div>
