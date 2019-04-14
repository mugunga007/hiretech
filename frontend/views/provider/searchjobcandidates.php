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

<?php
$projob = 'no';

 $session = Yii::$app->session;
$session->open();

?>
<div class="container">
    <div class="row  ">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 ">
            <?=$this->render('prodashlayout')?>
        </div>
        <div class="col-md-1">
        </div>

    </div>
    <div class="row">


        <div class="col-md-12">

            <div class="">
                <div class=" text-center">
                    <p><b> <div class="well well-sm">List of registered <?=$jobtypetitle?>(s)! </div> </b></p>

                    <?php $form = ActiveForm::begin([
                        'action'=>'searchjobcandidates',
                        'method'=>'get',
                        'layout'=>'inline',
                        'fieldConfig'=>[
                            //   'template'=>'{label}{beginWrapper}{input}{error}{endWrapper}'
                        ]
                    ])  ?>

                <?=
                 $form->field($searchresultmodel,'provider_job_id')->hiddenInput(['value'=>$session->get('projobid')])
                ?>

                    <?= $form->field($searchresultmodel,'address')->input('text',
                        ['placeholder'=>'Address'])?>



                    <?php
                    $jobtype = JobType::find()->all();
                    $listdata = ArrayHelper::map($jobtype,'job_type_id','title');
                    ?>


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




                    <div class="form-group" style="margin-top: 3px">

                        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn mybtnprimary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>


    </div>

    <div class="row">
    <div class="col-md-2">
    </div>
        <div class="col-md-8">

            <?php
            /**
             * Check if at least one candidate is selected for this job
             * and check the number of candidates selected for this job
             */
            $selectedseeker = new SelectedSeeker();
           // $selectednumber = $selectedseeker->selectedNumber(Yii::$app->user->identity->provider->provider_id);
            $selectednumber = $selectedseeker->numberOfCandidatesByJob($provider_job_id);
            if($selectednumber != 0) {
                ?>

                <div class="alert alert-info text-center somespace animated bounceIn">
                    <a
                        href="<?=Url::to(['provider/candidatesbyjob','provider_job_id'=>$provider_job_id])?>"
                        class="alert-link">
                        <span class="fa fa-spinner fa-spin"></span>
                        Click to Confirm Selected Candidates (<?=$selectednumber?>)
                    </a>
                </div>
                <?php
            }
            ?>

            <?php

            $selectednumber = new SelectedSeeker();

            $criteria = new SeekerSearchForm();
            $criteria->setJobtypeid($searchresultmodel->jobtypeid);
            echo 'Search: <b>Address:</b>'. $searchresultmodel->address;

            $page = 1;
            if(ArrayHelper::getValue(Yii::$app->request->queryParams,'page')!=null)
            $page = ArrayHelper::getValue(Yii::$app->request->queryParams,'page');

            $per_page = ArrayHelper::getValue(Yii::$app->request->queryParams,'per-page');




            echo ListView::widget([
                'dataProvider'=>$model,
                'itemView'=>'/seeker/_seekerjobcandidates',
                'emptyText'=>'No results found!',

                'viewParams'=>[
                    'providerid'=>Yii::$app->user->identity->provider->provider_id,
                    'jobtypeid'=>$searchresultmodel->jobtypeid,
                    'provider_job_id'=>$provider_job_id,
                    'address'=>$searchresultmodel->address,

                    'min_age'=>$searchresultmodel->min_age,
                    'max_age'=>$searchresultmodel->max_age,
                    'gender'=>$searchresultmodel->gender,
                    'page'=>$page,
                   // 'per_page'=>$per_page,




                ]
            ]);


            ?>

        </div>


    </div>

</div>
