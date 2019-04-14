<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use frontend\models\JobType;
use yii\helpers\ArrayHelper;
use frontend\models\SeekerSearchForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SeekerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


use yii\widgets\ListView;
?>

<div class="container">

    <div class="col-md-4">
<?php
/*

         $searchresultmodel = new SeekerSearchForm();
         ?>
<?=$this->render('searchseeker',[
    'searchresultmodel' => $searchresultmodel,
])
*/
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

    </div>
    <div class="col-md-8">

        <?php
        $criteria = new SeekerSearchForm();
        $criteria->setJobtypeid($searchresultmodel->jobtypeid);
        echo 'Address:'. $searchresultmodel->address. ', Job Type: '.$searchresultmodel->jobtypeid;

        echo ListView::widget([
           'dataProvider'=>$model,
           'itemView'=>'_seeker',
            'viewParams'=>[
                    'address'=>$searchresultmodel->address,
                    'jobtypeid'=>$searchresultmodel->jobtypeid,
            ]
        ]);


        ?>

    </div>



</div>
