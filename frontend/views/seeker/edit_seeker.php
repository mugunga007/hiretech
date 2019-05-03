<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/03
 * Time: 18:26
 */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('app', 'Edit Profile: {name}', [
    'name' => Yii::$app->user->identity->seeker->firstname,
]);

$this->params['breadcrumbs'][] = ['label' => 'My Profile', 'url' => ['view', 'id' => Yii::$app->user->identity->seeker->seeker_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


?>

<?=$this->render('seekerdashlayout')?>

<?php
/*
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
*/

?>

<div class="row">

    <div class="col-md-4">
    </div>

    <div class="col-md-4">
        <div data-aos="fade-left">
            <div class="myform">


                <?= $this->render('_form_update', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
    </div>

</div>

