<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SelectedSeeker */

$this->title = $model->selected_seeker_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Selected Seekers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="selected-seeker-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->selected_seeker_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->selected_seeker_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'selected_seeker_id',
            'search_id',
            'seeker_id',
            'provider_id',
            'status',
            'selection_time',
            'availability_time',
            'deadline',
            'address',
            'job_description',
            'message',
            'confirmation_time',
        ],
    ]) ?>

</div>
