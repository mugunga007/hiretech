<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
//use azraf\simpleapp\classes\SimpleNav as Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Seeker;
use yii\helpers\Url;
use frontend\models\Myfunctions;

use frontend\models\SeekerNotification;
use frontend\components\SmallBody;
use frontend\models\ProviderNotification;
use frontend\models\Provider;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<br>
<?php $this->beginBody() ?>

<div class="wrap ">



    <?php
    $seeker_notifications = new SeekerNotification();
    $provider_notifications = new ProviderNotification();
    $function = new Myfunctions();
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/HireTechLogo1.png',
            ['alt'=>Yii::$app->name,
                'class' => '','width'=>'50px']),


        //Yii::$app->name,

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top ',

        ],

    ]);

    $menuItems =[
        ['label' => '<i class="fa fa-edit"></i>  Contact', 'url' => ['/site/contact']],
        ['label' => '<i class="fa fa-smile"></i>  Give Us a FeedBack.',
            'url' => 'https://docs.google.com/forms/d/e/1FAIpQLSftczth8fAu4k7Jn2HT1PMDHdNoQLdK1rDZ8bK7SkkqWGakAQ/viewform?usp=sf_link',
            'linkOptions'=>[
                    'target'=>'_blank'
            ]
            ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fa fa-user-cog"></i>  Signup as', 'url' => ['/site/signup'],
            'items'=>[
            ['label' => '<i class="fa fa-address-card"></i>  Job Seeker', 'url' => ['/seeker/create']],
            ['label' => '<i class="fa fa-address-card"></i>  Job Provider', 'url' => ['/provider/create']],
        ]];

/*
        $menuItems[] = ['label' => '<i class="fa fa-sign-in-alt"></i> Login as', 'url' => ['/site/login']];
*/
    } else {
        $role = Yii::$app->user->identity->role;
        $name = '';
        if ($role == 'seeker') {


            $seeker = Seeker::findOne(Yii::$app->user->identity->seeker->seeker_id);

            $name = $seeker->firstname;
            $notifications = $seeker_notifications->check_new_notifications($seeker->seeker_id);

            $menuItems[] =
                ['label'=>'<i class="fa fa-tachometer-alt"></i> My Dashboard   </li>',
                    'url'=>['seeker/seekerdashboard'] ];


                    $items = [];
                    foreach ($notifications->all() as $not){
                        array_push($items,['label'=>
                            '<b>'.SmallBody::widget(['body'=>$not->message]).'</b> <small>'.$function->time_elapsed_string($not->time).'</small>',
                            'url'=>['seeker/notifications']]);
                    }
        //    if($notifications->count() > 0){
            if($notifications->count()>0) {
                $menuItems[] = ['label' => '<i class="fa fa-bell"></i> 
 <span class="label label-danger">' . $notifications->count() . ' </span>', 'url' => ['/site/signup'],
                    'items' => $items,
                ];
            }else{
                $menuItems[] =
                    ['label'=>'<i class="fa fa-bell"></i> 
 <span class="label label-default">' . $notifications->count() . ' </span> </li>',
                        'url'=>['seeker/notifications'] ];
            }
// }



                $menuItems[]=['label'=>'<b>'.$name.'</b>','url'=>['seeker/seekerprofile'],
                    'items'=>[
                            ['label'=>'<i class="fa fa-user-cog"></i> My Profile','url'=>['seeker/myprofile']],
                          //  ['label'=>'<i class="fa fa-sign-out-alt"></i> Sign out','url'=>['site/logout']],

                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            '<i class="fa fa-sign-out-alt"></i> Sign out',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'

                        // ['label'=>'<i class="fa fa-sign-out-alt"></i> Sign out','url'=>[''.Yii::app()->createAbsoluteUrl('/site/logout').'']],
            ]

                ];
        } elseif ($role == 'provider') {
            $provider = Provider::findOne(Yii::$app->user->identity->provider->provider_id);
            $name = $provider->names;

            $menuItems[] =
                ['label'=>'<i class="fa fa-tachometer-alt"></i> Dashboard  </a> </li>',
               'url'=>['provider/providerdashboard'] ];

            $pro_notifications = $provider_notifications->check_new_notifications($provider->provider_id);
            $items = [];
            foreach ($pro_notifications->all() as $not){
                array_push($items,['label'=>
                    '<b>'.SmallBody::widget(['body'=>$not->message]).'</b> <small>'.$function->time_elapsed_string($not->time).'</small>',
                    'url'=>['provider/notifications']]);
            }
            //    if($notifications->count() > 0){
            if($pro_notifications->count()>0) {
                $menuItems[] = ['label' => '<i class="fa fa-bell"></i> 
 <span class="label label-danger">' . $pro_notifications->count() . ' </span>', 'url' => ['/site/signup'],
                    'items' => $items,
                ];
            }else{
                $menuItems[] =
                    ['label'=>'<i class="fa fa-bell"></i> 
 <span class="label label-default">' . $pro_notifications->count() . ' </span> </li>',
                        'url'=>['seeker/notifications'] ];
            }

            $menuItems[]=


               '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . $name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';

        } else {
            $name = Yii::$app->user->identity->username;

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-sign-out-alt"></i> Logout <small>(' . $name . ')</small>',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right navbar-justified'],
        'items' => $menuItems,
        'encodeLabels' => false,

    ]);
    NavBar::end();
    ?>

<div class="container">
        <?php

        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
         ?>

        <?= Alert::widget() ?>
        <?= $content ?>


</div>

<div class="push"></div>
</div>

<footer class="footer ">
    <div class="container">
        <p class="pull-left">&copy;
            <?=Html::img('@web/img/HireTechLogo1.png', ['alt'=>Yii::$app->name, 'class' => '','width'=>'40'])?>
            HireTech <?= date('Y') ?></p>

        <p class="pull-right">&copy; S. Landry Design </p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<script>
    AOS.init();
</script>
<?php $this->endPage() ?>
