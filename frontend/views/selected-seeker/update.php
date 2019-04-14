<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SelectedSeeker */

$this->title = Yii::t('app', 'Update Selected Seeker: {name}', [
    'name' => $model->selected_seeker_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Selected Seekers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->selected_seeker_id, 'url' => ['view', 'id' => $model->selected_seeker_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="selected-seeker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
