<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\JobType */

$this->title = Yii::t('app', 'Update Job Type: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->job_type_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="job-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
