<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SelectedSeeker */

$this->title = Yii::t('app', 'Create Selected Seeker');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Selected Seekers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selected-seeker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
