<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/mystyle.css',
        'css/animate.css',
        'https://unpkg.com/aos@next/dist/aos.css',
        'css/all.css',
        'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css',
        'https://use.fontawesome.com/releases/v5.8.1/css/all.css'
    ];
    public $js = [
        'https://unpkg.com/aos@next/dist/aos.js',
        'https://cdn.jsdelivr.net/npm/sweetalert2@8'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
