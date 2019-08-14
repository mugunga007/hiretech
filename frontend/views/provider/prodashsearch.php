<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/01/12
 * Time: 0:07
 */

//use yii\widgets\ActiveForm;
use frontend\models\JobType;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\models\SeekerSearchForm;
use frontend\models\SelectedSeeker;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>



            <?=$this->render('prodashlayout')?>


    <div class="row">

        <div class="col-md-12">

            <div class="well well-sm text-center" >
                <p><b> Choose Candidates you would like to interview!  </b></p>
            </div>
        </div>
    </div>
                <div class="row">
        <div class="col-md-12">

                <?php $form = ActiveForm::begin([
                        'action'=>'prodashsearch',
                        'method'=>'get',
                        'layout'=>'inline',
                        'fieldConfig'=>[
                             //   'template'=>'{label}{beginWrapper}{input}{error}{endWrapper}'
]
                        ])  ?>




                <?= $form->field($searchresultmodel,'address')->input('text',
                    ['placeholder'=>'Address'])?>



                <?php
                $jobtype = JobType::find()->all();
                $listdata = ArrayHelper::map($jobtype,'job_type_id','title');
                ?>


                <?= $form->field($searchresultmodel,'jobtypeid')->dropDownList(
                    $listdata,
                    ['prompt'=>'Job Career']
                )?>

                <label for="min_age"> Age: From </label>

                <?=
                $form->field($searchresultmodel,'min_age' )->input('number',
                    ['placeholder'=>'From'])

                ?>

                    <label for="min_age"> To </label>
                <?=$form->field($searchresultmodel,'max_age')->input('number',
                    ['placeholder'=>'To'])?>
                <?php
                $gender = [
                        ['gender'=>'male','name'=>'M'],
                        ['gender'=>'female','name'=>'F'],
                ];
                $gender_list = ArrayHelper::map($gender,'gender','name')
                ?>

                <label for="gender"> Gender: </label>
                <?=$form->field($searchresultmodel,'gender')->dropDownList(
                        $gender_list,
                        ['prompt'=>'Any']
                )?>




                <div class="form-group " style="margin-top: 3px">

                    <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn mybtnprimary']) ?>
                </div>


                <?php ActiveForm::end(); ?>




</div>

    </div>

    <div class="row">
<div class="col-md-2">
</div>
        <div class="col-md-8">


            <?php

            $selectednumber = new SelectedSeeker();

            $criteria = new SeekerSearchForm();
            $criteria->setJobtypeid($searchresultmodel->jobtypeid);
            echo 'Search: <b>Address:</b>'. $searchresultmodel->address. ', <b>Job Type:</b> '.$searchjob.',
                    <b>Age:</b>'.$searchresultmodel->min_age.'-'.$searchresultmodel->max_age.'';


            echo ListView::widget([
                'dataProvider'=>$model,
                'itemView'=>'/seeker/_seeker',
                'emptyText'=>'No results found!',
                'viewParams'=>[
                        'jobtypeid'=>$searchresultmodel->jobtypeid,
                        'providerid'=>Yii::$app->user->identity->provider->provider_id,
                        'address'=>$searchresultmodel->address,
                        'jobtypeid'=>$searchresultmodel->jobtypeid,
                        'min_age'=>$searchresultmodel->min_age,
                        'max_age'=>$searchresultmodel->max_age,
                        'gender'=>$searchresultmodel->gender

                ]
            ]);


            ?>

        </div>

    </div>







