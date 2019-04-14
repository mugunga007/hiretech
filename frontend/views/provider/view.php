<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Provider */

//$this->title = $model->provider_id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Providers'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="provider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['/provider/update', 'id' => $model->provider_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['/provider/delete', 'id' => $model->provider_id], [
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
            'provider_id',
            'names',
            'email:email',
           // 'password',
            'type',
            'address',
            'phone',
            'time',
        ],
    ]) ?>

</div>
