<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Seeker */

$this->title = Yii::t('app', 'Update Seeker: {name}', [
    'name' => $model->seeker_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seekers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->seeker_id, 'url' => ['view', 'id' => $model->seeker_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="seeker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
