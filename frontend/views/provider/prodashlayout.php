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

            /*
            ['label'=>' Saved Search',
                'url'=>['provider/index'],
                'template'=>' <a href="{url}"> <i class="fa fa-history"></i> {label} </a>'
            ],

            */


            ['label'=>' Saved Profiles',
                'url'=>['provider/bookmarkspage'],
                'template'=>' <a href="{url}"> <i class="fa fa-bookmark"></i> {label} ('.$bookmark_seeker->number_of_bookmarked($provider_id).') </a>'
            ],



        ],

            'activeCssClass'=>'myactive',
          'options' => [
              'class' => 'nav nav-justified',

              'style'=>'font-size: 14px;',
              'data-tag'=>'yii2-menu',
          ],
        ]
    )
    ?>

    </div>

</div>
<hr>
