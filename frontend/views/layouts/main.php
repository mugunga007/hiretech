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



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap body-background">



    <?php
    NavBar::begin([
        'brandLabel' => 'HireTechs',
            //Yii::$app->name,

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top text-center',

        ],

    ]);

    $menuItems = [
        ['label' => '<i class="fa fa-home "></i>  Home', 'url' => ['/site/index'],
        'glyphicon'=>'cog',
        ],
        /*
        ['label' => '<i class="fa fa-book-open"></i> About', 'url' => ['/site/about'],
            'icon'=>'cog',
            ],
        */
        ['label' => '<i class="fa fa-edit"></i>  Contact', 'url' => ['/site/contact']],
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



            $name = Yii::$app->user->identity->seeker->firstname;
            $menuItems[] =
                ['label'=>'<i class="fa fa-tachometer-alt"></i> My Dashboard  </a> </li>',
                    'url'=>['seeker/seekerdashboard'] ];
            $menuItems[] =
                '<li> <a href="'.Url::to(['seeker/seekerdashboard']).'" class=""><i class="fa fa-bell "></i> <span class="label label-danger">1</span>  </a> </li>'.
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . $name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
                ;
        } elseif ($role == 'provider') {
            $name = Yii::$app->user->identity->provider->names;

            $menuItems[] =
                ['label'=>'<i class="fa fa-tachometer-alt"></i> Dashboard  </a> </li>',
               'url'=>['provider/providerdashboard'] ];
            $menuItems[]=


                '<li><a class="far fa-bell" href="'.Url::to(['provider/providerdashboard']).'">
                 <span class="label label-danger">1</span>  </a> </li>'.
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
                    'Logout (' . $name . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,

    ]);
    NavBar::end();
    ?>

<div class="container">

        <?php
        /*
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        */ ?>

        <?= Alert::widget() ?>
        <?= $content ?>
</div>
</div>
<footer class="footer">

        <p class="pull-left">&copy; HireTech <?= date('Y') ?></p>

        <p class="pull-right">&copy; S. Landry Design </p>

</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    AOS.init();
</script>