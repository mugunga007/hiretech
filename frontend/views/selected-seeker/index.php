<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SelectedSeekerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Selected Seekers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="selected-seeker-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Selected Seeker'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'selected_seeker_id',
            'search_id',
            'seeker_id',
            'provider_id',
            'status',
            //'selection_time',
            //'availability_time',
            //'deadline',
            //'address',
            //'job_description',
            //'message',
            //'confirmation_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
