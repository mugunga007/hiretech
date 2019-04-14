<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\JobType */

$this->title = Yii::t('app', 'Create Job Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
