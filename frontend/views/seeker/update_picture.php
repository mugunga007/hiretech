<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/06
 * Time: 7:54
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

// THIS PAGE IS NOT BEING USED
?>

<?=$this->render('seekerdashlayout')?>

<div class="row">

    <div class="col-md-4">
    </div>

    <div class="col-md-4">
        <?php $form = ActiveForm::begin([
            'action'=>'updatepicture',

            'options'=>['enctype'=>'multipart/form-data']]); ?>

        <?= $form->field($model, 'picture')->fileInput() ?>



        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn mybtnprimary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-md-4">
    </div>

</div>
