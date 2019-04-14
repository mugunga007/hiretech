<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Seeker */

$this->title = $model->seeker_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seekers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="seeker-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->seeker_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->seeker_id], [
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
            'seeker_id',
            'firstname',
            'lastname',
            'picture',
            'email:email',
            'password',
            'dob',
            'gender',
            'phone',
            'address',
            'job_type_id',
            'experience',
            'views',
            'time',
        ],
    ]) ?>

</div>
