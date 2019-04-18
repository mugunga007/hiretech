<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProviderJob;
use frontend\models\ProviderJobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;
use yii\filters\AccessControl;

/**
 * ProviderJobController implements the CRUD actions for ProviderJob model.
 */
class ProviderJobController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
                'access'=>[
                    'class'=>AccessControl::className(),
                    'rules'=>[
                        [
                            'allow'=>true,
                            'roles'=>['@']
                        ],


                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all ProviderJob models.
     * @return mixed
     */

    /*
    public function actionIndex()
    {
        $searchModel = new ProviderJobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    */

    /**
     * Displays a single ProviderJob model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProviderJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $number = 2;
        $model = new ProviderJob();

        $model->load(Yii::$app->request->post());

            $model->job_title = strtolower($model->job_title);

            if( $model->save()) {
            $number = 1;
                return $this->render('/provider/providerjobview',
                    [
                        'number'=>$number
                    ]);
            }

        else {
            $number = 0;
            return $this->render('create', [
                'model' => $model,
                'number'=>$number
            ]);
        }
    }

    /**
     * Reopen Offer
     */

    public function actionReopen($provider_job_id){
        $provider_job_reopened = new ProviderJob();

       // $provider_job = new ProviderJob();

        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
     //   $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
       // $provider_job_reopened = $provider_job;


        $provider_job_reopened->provider_id = $provider_job->provider_id;
        $provider_job_reopened->job_title = $provider_job->job_title." round ".($provider_job->round+1);
        $provider_job_reopened->job_type_id = $provider_job->job_type_id;
        $provider_job_reopened->location = $provider_job->location;
        $provider_job_reopened->description = $provider_job->description;
        $provider_job_reopened->salary = $provider_job->salary;
        $provider_job_reopened->work_hours = $provider_job->work_hours;
        $provider_job_reopened->contract_type = $provider_job->contract_type;
        $provider_job_reopened->status = 1;
       // $provider_job_reopened->date = $date_time->format('Y-m-d H:i:s');
      //  $provider_job_reopened->last_edit = $date_time->format('Y-m-d H:i:s');
        $provider_job_reopened->round = $provider_job->round +1;

        $provider_job->status = 4;
        $provider_job->save();
        $provider_job_reopened->save();

        return $this->redirect(Yii::$app->request->referrer);

    }

    /**
     * Updates an existing ProviderJob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->provider_job_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     *
     */

    /**
     * Deletes an existing ProviderJob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProviderJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProviderJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProviderJob::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
