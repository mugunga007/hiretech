<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/08
 * Time: 6:06
 */
use yii\widgets\ActiveForm;
use frontend\models\JobType;
use yii\helpers\ArrayHelper;
?>


<?php $form = ActiveForm::begin(['action' => ['searchseekerss'],
        'method' => 'get',
        ]) ?>

<?= $form->field($searchresultmodel,'address')->textInput()?>
<?php
$jobtype = JobType::find()->all();
$listdata = ArrayHelper::map($jobtype,'job_type_id','title');
?>
<?= $form->field($searchresultmodel,'jobtypeid')->dropDownList(
    $listdata,
    ['prompt'=>'Select']
)?>


<div class="form-group">

    <button class="btn btn-success" >Search <i class="fa fa-search"></i></button>
</div>

<?php ActiveForm::end(); ?>
