<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderJob */

$this->title = Yii::t('app', 'Update Provider Job: {name}', [
    'name' => $model->provider_job_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provider Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->provider_job_id, 'url' => ['view', 'id' => $model->provider_job_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="provider-job-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
