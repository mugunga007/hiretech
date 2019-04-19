<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\BookmarkSeeker;
use frontend\models\SignupForm;
use Yii;
use frontend\models\Provider;
use frontend\models\ProviderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\controllers\SeekerController;
use frontend\models\SeekerSearchForm;
use yii\data\ActiveDataProvider;
use frontend\models\Seeker;
use frontend\models\JobType;
use frontend\models\Search;
use frontend\models\SelectedSeeker;
use yii\db\Connection;
use frontend\models\ProviderJob;
use frontend\models\ProviderJobSearch;
use DateTime;
use yii\data\Sort;
use yii\filters\AccessControl;


/**
 * ProviderController implements the CRUD actions for Provider model.
 */

class ProviderController extends Controller
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
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'except'=>['create'],
                'rules'=>[
                    [
                      'allow'=>true,
                      'roles'=>['@']
                    ],


                ]

        ]];



    }

    /**
     * Lists all Provider models.
     * @return mixed
     */
    /*
    public function actionIndex()
    {
        $searchModel = new ProviderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    */

    /**
     * Displays a single Provider model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /*
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    */

    /**
     * Creates a new Provider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        $model = new Provider();
        $newuser = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            $newuser->email = $model->email;
            $newuser->password = $model->password;
            $newuser->username = $model->email;
            $newuser->role = 'provider';

            if($user = $newuser->signup()){
                if(Yii::$app->getUser()->login($user)){

            return $this->redirect(['view', 'id' => $model->provider_id]);
                }
            }


        }else

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Provider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->provider_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Provider model.
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
     * Provider dashboard
     */

    public function actionProdashsearch()
    {
        $searchresultmodel = new SeekerSearchForm();

        $searchresultmodel->min_age = 18;
        $searchresultmodel->max_age = 50;

        $model = null;
         ($searchresultmodel->load(Yii::$app->request->queryParams));

         //--------- CALCULATE AGE  ------------------------

        $min_age_date = date('Y-m-d',strtotime($searchresultmodel->min_age . 'years ago'));
        $max_age_date = date('Y-m-d',strtotime($searchresultmodel->max_age . 'years ago'));

        //--------------------------------------------------

            $model = new ActiveDataProvider([
                'query' =>
                    Seeker::find()
                        ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                        ->where(['seeker_job_type.job_type_id' => $searchresultmodel->jobtypeid])
                        ->AndWhere(['like',
                            'seeker.address',
                            ['seeker.address' => $searchresultmodel->address]
                        ])
                        ->andfilterWhere(['seeker.gender'=>$searchresultmodel->gender])
                        ->andFilterWhere(['<=','seeker.dob',$min_age_date])
                        ->andFilterWhere(['>=','seeker.dob',$max_age_date])

                        ,
                'pagination' => [
                    'pageSize' => 6
                ]
            ]);
            $searchjob = '';
            if($searchresultmodel->jobtypeid!= null)
                $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;



            return $this->render('prodashsearch', [
                'model' => $model,
                'searchresultmodel' => $searchresultmodel,
                'searchjob'=> $searchjob,


            ]);


    }

    /**
     * Provider dashboard
     */

    public function actionSearchdumb()
    {
        $searchresultmodel = new SeekerSearchForm();

        $searchresultmodel->min_age = 18;
        $searchresultmodel->max_age = 50;

        $model = null;
        ($searchresultmodel->load(Yii::$app->request->queryParams));

        //--------- CALCULATE AGE  ------------------------

        $min_age_date = date('Y-m-d',strtotime($searchresultmodel->min_age . 'years ago'));
        $max_age_date = date('Y-m-d',strtotime($searchresultmodel->max_age . 'years ago'));

        //--------------------------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $searchresultmodel->jobtypeid])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ])
                    ->andfilterWhere(['seeker.gender'=>$searchresultmodel->gender])
                    ->andFilterWhere(['<=','seeker.dob',$min_age_date])
                    ->andFilterWhere(['>=','seeker.dob',$max_age_date])

            ,
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
        $searchjob = '';
        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;



        return $this->render('searchdumb', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,


        ]);


    }


    /**
     * Function to go to the searchjobcandidates link
     *
     */

    public function actionSearchjobcandidatespage($provider_job_id){
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $job_type_id = $providerjob->job_type_id;
        $searchresultmodel = new SeekerSearchForm();
        $jobtype = JobType::findOne(['job_type_id'=>$job_type_id]);
        $jobtypetitle = $jobtype->title;
        $model = null;
        $searchresultmodel->address = '';
        $searchresultmodel->min_age = 18;
        $searchresultmodel->max_age = 50;
        $searchresultmodel->gender = '';

        ($searchresultmodel->load(Yii::$app->request->queryParams));

        //--------- CALCULATE AGE  ------------------------

        $min_age_date = date('Y-m-d',strtotime($searchresultmodel->min_age . 'years ago'));
        $max_age_date = date('Y-m-d',strtotime($searchresultmodel->max_age . 'years ago'));

        //--------------------------------------------------
        // Record Last edit on this job
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $job_type_id])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ])
                    ->andfilterWhere(['seeker.gender'=>$searchresultmodel->gender])
                    ->andFilterWhere(['<=','seeker.dob',$min_age_date])
                    ->andFilterWhere(['>=','seeker.dob',$max_age_date]),
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        $searchjob = '';
        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;


        // session 1st method

        $session = Yii::$app->session;
        $session->set('projobid',$provider_job_id);


        // Record Last edit on this job
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        return $this->render('searchjobcandidates', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,
            'jobtypetitle'=>$jobtypetitle,
            'provider_job_id'=>$provider_job_id,
            //  'session'=>$session,

        ]);

    }

    /**
     * Function to search candidates from a job link
     */

    public function actionSearchjobcandidates()
    {


        $searchresultmodel = new SeekerSearchForm();
        $model = null;
        $searchresultmodel->address = '';
        $searchresultmodel->min_age = 18;
        $searchresultmodel->max_age = 50;
        $searchresultmodel->gender = '';

       $searchresultmodel->load(Yii::$app->request->queryParams);
        /*
       $session = Yii::$app->session;
       $provider_job_id = $session->get('projobid') ;

       */

        $session = Yii::$app->session;
        $session->set('projobid',$searchresultmodel->provider_job_id);

        $provider_job_id = $searchresultmodel->provider_job_id;
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);

        $job_type_id = $providerjob->job_type_id;
        $jobtype = JobType::findOne(['job_type_id'=>$job_type_id]);
        $jobtypetitle = $jobtype->title;
        //--------- CALCULATE AGE  ------------------------

        $min_age_date = date('Y-m-d',strtotime($searchresultmodel->min_age . 'years ago'));
        $max_age_date = date('Y-m-d',strtotime($searchresultmodel->max_age . 'years ago'));

        //--------------------------------------------------
       // Record Last edit on this job
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
      //--------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $job_type_id])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ])
             ->andfilterWhere(['seeker.gender'=>$searchresultmodel->gender])
        ->andFilterWhere(['<=','seeker.dob',$min_age_date])
        ->andFilterWhere(['>=','seeker.dob',$max_age_date]),
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        $searchjob = '';
        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;


        // session 1st method
/*
        $session = Yii::$app->session;
        $session->set('projobid',$provider_job_id);
*/

        // Record Last edit on this job
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        return $this->render('searchjobcandidates', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,
            'jobtypetitle'=>$jobtypetitle,
            'provider_job_id'=>$provider_job_id,
          //  'session'=>$session,

        ]);


    }

    /**
     *  Select Seeker
     */

    public function actionSelectseeker($seekerid,$providerid,$projobid){

    $selectedseeker = new SelectedSeeker();

        // Record Last edit on this job
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$projobid]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        $providerjob = ProviderJob::findOne(['provider_job_id'=>$projobid]);
        $jobtypeid = $providerjob->job_type_id;
    $selectedseeker->seeker_id = $seekerid;
    $selectedseeker->status = 'Selected';
    $selectedseeker->provider_id = $providerid;
    $selectedseeker->job_type_searched = $jobtypeid;
    $selectedseeker->provider_job_id = $projobid;
    $selectedseeker->save();




    return $this->redirect(Yii::$app->request->referrer);



    }

    /**
     * Unselect Seeker
     */


    public function actionUnselectseeker($seekerid,$providerid,$provider_job_id){

        $selected = SelectedSeeker::findOne(['seeker_id'=>$seekerid,'provider_id'=>$providerid,'provider_job_id'=>$provider_job_id]);

        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------
        $selected->delete();
        return $this->redirect(Yii::$app->request->referrer);



    }

    /**
     * Confirm Selected candidates
     *
     */

    public function actionSelectedcandidates(){
        $providerid = Yii::$app->user->identity->provider->provider_id;
        $selectedlist = new ActiveDataProvider([

           'query'=>
            Seeker::find()
            ->join('join','selected_seeker','selected_seeker.seeker_id = seeker.seeker_id')
            ->where(['selected_seeker.provider_id'=>$providerid])
            ->andWhere(['selected_seeker.status'=>'Selected']),
            'pagination'=>[
                'pageSize'=>2
            ]

        ]);
        $model = new SelectedSeeker();

        return $this->render('selectedcandidates',
            [
                'selectedlist'=>$selectedlist,
                'model'=>$model,
            ]);
    }



    /**
     * Confirm Selected candidates
     *
     */

    public function actionCandidatesbyjob($provider_job_id){
        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $job_type_id = $provider_job->jobType->job_type_id;
        $providerid = Yii::$app->user->identity->provider->provider_id;
        $selectedlist = new ActiveDataProvider([

            'query'=>
                Seeker::find()
                    ->join('join','selected_seeker','selected_seeker.seeker_id = seeker.seeker_id')
                    ->where(['selected_seeker.provider_id'=>$providerid])
                    ->andWhere(['selected_seeker.status'=>'Selected'])
            ->andWhere(['selected_seeker.provider_job_id'=>$provider_job_id]),
            'pagination'=>[
                'pageSize'=>3
            ]

        ]);
        $model = new SelectedSeeker();

        return $this->render('selectedcandidatesbyjob',
            [
                'selectedlist'=>$selectedlist,
                'model'=>$model,
                'provider_job_id'=>$provider_job_id,
                'job_type_id'=>$job_type_id,
            ]);
    }

    public function actionConfirmedseeker(){
        $providerid = Yii::$app->user->identity->provider->provider_id;
        $selectedlist = new ActiveDataProvider([

            'query'=>
                Seeker::find()
                    ->join('join','selected_seeker','selected_seeker.seeker_id = seeker.seeker_id')
                    ->where(['selected_seeker.provider_id'=>$providerid])
                    ->andWhere(['selected_seeker.status'=>'Confirmed']),
            'pagination'=>[
                'pageSize'=>2
            ]

        ]);
        $model = new SelectedSeeker();

        return $this->render('confirmedseeker',
            [
                'selectedlist'=>$selectedlist,
                'model'=>$model,

            ]);
    }


    public function actionConfirmedseekerbyjob($provider_job_id){
        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $job_title = $provider_job->job_title;
        $providerid = Yii::$app->user->identity->provider->provider_id;

        $selectedlist = new ActiveDataProvider([

            'query'=>
                Seeker::find()
                    ->join('join','selected_seeker','selected_seeker.seeker_id = seeker.seeker_id')
                    ->where(['selected_seeker.provider_id'=>$providerid])
                    ->andWhere(['provider_job_id'=>$provider_job_id])
                    ->andWhere(['<>','selected_seeker.status','Selected']),
            'pagination'=>[
                'pageSize'=>2
            ]

        ]);
        // Record Last edit on this job
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------
        $model = new SelectedSeeker();

        return $this->render('confirmedseeker',
            [
                'selectedlist'=>$selectedlist,
               // 'model'=>$model,
                'provider_job_id'=>$provider_job_id,
                'job_title'=>$job_title,

            ]);
    }


    /**
     *
     * Confirming candidates form data and DB save


    public function actionConfirmform(){
     $selected = new SelectedSeeker();
     $selected->load(Yii::$app->request->post());
     $newStatus = 'Confirmed';
     $currentStatus = 'Selected';
     $connection = new Connection();
        $now = new DateTime();


        $myupdate = 'update selected_seeker set status="'.$newStatus.'"
        ,message="'.$selected->message.'"
        ,job_description="'.$selected->job_description.'"
        ,confirmation_time="'.$selected->confirmation_time.'"
       
         where status="Selected"';

        \Yii::$app->db->createCommand($myupdate)->execute();
        return $this->redirect(Yii::$app->request->referrer);

    }
     * */

    /**
     *
     * Confirming candidates form data and DB save
     */

    public function actionConfirmoffer(){


        $selected = new SelectedSeeker();

        $selected->load(Yii::$app->request->post());

        $today = new DateTime();
        $todayString = $today->format('Y-m-d H:i:s');

        $provider_job_id = $selected->provider_job_id;
        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);

        SelectedSeeker::updateAll([
            'status'=>'Confirmed',
            'message'=>$selected->message,
            'confirmation_time'=>$todayString
        ],
            ['provider_id'=>$selected->provider_id,
                'provider_job_id'=>$selected->provider_job_id,
                'status'=>'Selected']);

        /*
        $selected_list = SelectedSeeker::find()
            ->where(['provider_id'=>$selected->provider_id])
            ->andWhere(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Selected']);
        $selected_list->status = 'Confirmed';
        $selected_list->message = $selected->message;
        $selected_list->confirmation_time = new DateTime();
        $selected_list->save();
*/

        /*
        $myupdate = 'update selected_seeker set status="Confirmed"
        ,message="'.$selected->message.'"
       ,confirmation_time="'.$selected->confirmation_time.'"
         where provider_id="'.$selected->provider_id.'"
           and provider_job_id="'.$selected->provider_job_id.'"
          and status="Selected"';
        \Yii::$app->db->createCommand($myupdate)->execute();



        /*
        /**
         * Update Provider_job table status to 3
        */
        $provider_job->status = 3;
        $provider_job->save();

        return $this->redirect(Yii::$app->request->referrer);

    }

    /**
     *
     * Provider dashboard layout
     */

    public function actionProviderdashboard(){

        $provider_id = Yii::$app->user->identity->provider->provider_id;
    $provider_job = new ActiveDataProvider([
        'query' => ProviderJob::find()
        ->where(['provider_id'=>$provider_id])
        ->andWhere(['>=','status',3])
    ]);



        return $this->render('providerdashboard',
            [
                'provider_job'=>$provider_job,

            ]);
    }

    /**
     *
     * Provider dashboard layout
     */

    public function actionProviderdashboardcandidates($provider_job_id){

    }

    /**
     *
     * ProviderJob form
     */

    public function actionProviderjobgoto(){
    $model = new ProviderJob();

        $provider_id = Yii::$app->user->identity->provider->provider_id;
        $providerjoblist = ProviderJob::find()->where(['provider_id'=>$provider_id])->all();



        // dataProvider for the list view

        $dataProvider = new ActiveDataProvider([
            'query'=> ProviderJob::find()
                ->where(['provider_id'=>$provider_id])
                ->orderBy([
                    'date'=>SORT_DESC,
                ]),


            'pagination'=>[
                'pageSize'=>6
            ]
        ]);



    return  $this->render(
        'projobview',
        //'../provider-job/_providerjob',
        [
        'dataProvider'=>$dataProvider,
       'model'=>$model,
      //  'searchModel'=>$searchModel,
            'providerjoblist'=>$providerjoblist
    ]);

    }

    /**
     * List of bookmarked seekers
     */

    public function actionBookmarkedseekers(){
    $provider_id = Yii::$app->user->identity->provider->provider_id;
        $bookmarked = new ActiveDataProvider([
            'query'=>Seeker::find()
            ->join('join','bookmark_seeker','seeker.seeker_id = bookmark_seeker.seeker_id')
            ->where(['bookmark_seeker.provider_id'=>$provider_id])
        ]);

        return $this->render('bookmarked_seekers',
            ['bookmarked'=>$bookmarked]);

    }


    /**
     * Bookmarked page
     */

    public function actionBookmarkspage(){

        $distinct_bookmarks = BookmarkSeeker::find()
            ->select('job_type_id')
            ->distinct()

      ->where(['provider_id'=>10])
            ->all()
        ;

        ;

        return $this->render('bookmarkspage',
            [
                'distinct_bookmarks'=>$distinct_bookmarks,
            ]);

    }

    /**
     * Getting bookmarks by jobtype
     */

    public function actionJobtypebookmarks($job_type_id){

        $provider_id = Yii::$app->user->identity->provider->provider_id;
        $jobtype = JobType::findOne(['job_type_id'=>$job_type_id]);



        $job_type_bookmarks = new ActiveDataProvider([
            'query'=> Seeker::find()
            ->join('join','bookmark_seeker','seeker.seeker_id = bookmark_seeker.seeker_id')
            ->where(['bookmark_seeker.job_type_id'=>$job_type_id])
            ->andWhere(['provider_id'=>$provider_id])

            ,
            'pagination'=>[
                'pageSize'=>6
            ]
            ]);

        return $this->render('jobtypebookmarks',[
            'job_type_bookmarks'=>$job_type_bookmarks,
            'jobtype'=>$jobtype,

        ]);

}

    /**
     * Unbookmark from bookmarked seekers page
     */

    public function actionUnbook($provider_id,$seeker_id){

        $bookmark = BookmarkSeeker::findOne(['provider_id'=>$provider_id,'seeker_id'=>$seeker_id]);

        $bookmark->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     *
     * Provider function to Create Job offering description
     */

    public function actionProviderjobcreate(){
        $pjob = new ProviderJob();
        $providerid = Yii::$app->user->identity->provider->provider_id;
        $pjob->load(Yii::$app->request->get());
            $pjob->provider_id = $providerid;
            $pjob->job_title = strtolower($pjob->job_title);
            if($pjob->validate()) {
                $pjob->save();
                Yii::$app->getSession()->setFlash('success',
                    'Offer Saved Successfully',
                    'true'


                );

                return $this->redirect('providerjobgoto');
            }

        else
            return $this->render('/provider-job/create',[
                'model'=>$pjob
            ]);
    }

    /**
     *  Delete provider_job
     */

    public function actionDeleteproviderjob($provider_job_id){
        $provider_job = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        if($provider_job->delete()) {
            Yii::$app->getSession()->setFlash('success',
                'Offer Entitled "<b>'.$provider_job->job_title.'</b>" Deleted Successfully <b><i class="far fa-check-circle"></i></b>');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }


    /**
     *
     *  Show accepted seekers
     */

    public function actionShowacceptedcandidates($provider_job_id){
        $candidates = SelectedSeeker::find()
            ->where(['provider_job_id'=>$provider_job_id])
            ->andWhere(['status'=>'Accepted']);

        return $this->render('providerdashboard',[
            'candidates'=>$candidates,
        ]);
    }



    /**
     * Link to providerjobs
     */


    /**
     * Test page
     */

    public function actionTest(){
        $time = date('H:i:s');
      return  $this->render('test',[
          'time'=>$time
      ]);
    }

    public function actionProviderjobs(){
        $model = new ProviderJob();
        $number = 2;


      return  $this->render('/provider-job/create',
            ['model'=>$model,
                'number'=>$number]);
    }

    /**
     * Bookmark seeker from job candidates
     */

    public function actionBookmarkjobcandidates($provider_job_id,

                                                $seeker_id,
                                                $address,

                                                $min_age,
                                                $max_age,
                                                $gender

                                                ){
        $bookmark_seeker = new BookmarkSeeker();
        $provider_id = Yii::$app->user->identity->provider->provider_id;
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $job_type_id = $providerjob->job_type_id;
        $searchresultmodel = new SeekerSearchForm();
        $jobtype = JobType::findOne(['job_type_id'=>$job_type_id]);
        $jobtypetitle = $jobtype->title;
        $model = null;
        $searchresultmodel->address = $address;
        $searchresultmodel->min_age = $min_age;
        $searchresultmodel->max_age = $max_age;
        $searchresultmodel->gender = $gender;

        ($searchresultmodel->load(Yii::$app->request->queryParams));


        // Record Last edit on this job
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $job_type_id])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ]),
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        $searchjob = '';
        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;


        // session 1st method

        $session = Yii::$app->session;
        $session->set('projobid',$provider_job_id);


        // Record Last edit on this job
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        //-----------Save Bookmark---------------------

        if($bookmark_seeker->getBookmark($provider_id,$seeker_id)==null) {
            $bookmark_seeker->provider_id = $provider_id;
            $bookmark_seeker->seeker_id = $seeker_id;
            $bookmark_seeker->job_type_id = $job_type_id;
            $bookmark_seeker->save();
        }

        return $this->render('searchjobcandidates', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,
            'jobtypetitle'=>$jobtypetitle,
            'provider_job_id'=>$provider_job_id,


            //  'session'=>$session,

        ]);


    }

    /**
     * Bookmark seeker from job candidates
     */

    public function actionUnbookmarkjobcandidates($provider_job_id,

                                                $seeker_id,
                                                $address,

                                                $min_age,
                                                $max_age,
                                                $gender

    ){

        $provider_id = Yii::$app->user->identity->provider->provider_id;
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $job_type_id = $providerjob->job_type_id;
        $searchresultmodel = new SeekerSearchForm();
        $jobtype = JobType::findOne(['job_type_id'=>$job_type_id]);
        $jobtypetitle = $jobtype->title;
        $model = null;
        $searchresultmodel->address = $address;
        $searchresultmodel->min_age = $min_age;
        $searchresultmodel->max_age = $max_age;
        $searchresultmodel->gender = $gender;

        ($searchresultmodel->load(Yii::$app->request->queryParams));


        // Record Last edit on this job
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $job_type_id])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ]),
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
        $searchjob = '';
        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;


        // session 1st method

        $session = Yii::$app->session;
        $session->set('projobid',$provider_job_id);


        // Record Last edit on this job
        $providerjob = ProviderJob::findOne(['provider_job_id'=>$provider_job_id]);
        $date_time = new DateTime();
        $providerjob->last_edit = $date_time->format('Y-m-d H:i:s');
        $providerjob->save();
        //--------------------------------

        //-----------Save Bookmark---------------------
        $bookmark_seeker = new BookmarkSeeker();
        if($bookmark_seeker->getBookmark($provider_id,$seeker_id)!=null) {
            $bookmark_seeker = $bookmark_seeker->getBookmark($provider_id,$seeker_id);
            $bookmark_seeker->delete();
        }


        return $this->render('searchjobcandidates', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,
            'jobtypetitle'=>$jobtypetitle,
            'provider_job_id'=>$provider_job_id,
            //  'session'=>$session,

        ]);


    }

    /**
     * Bookmark Seeker
     */

    public function actionBookmarkseeker($provider_id,
                                         $seeker_id,
                                        $address,
    $jobtypeid,
    $min_age,
    $max_age,
    $gender
    ){

        //----------------- Searh Result Page -----------------------

        $searchresultmodel = new SeekerSearchForm();
        $searchresultmodel->address = $address;
        $searchresultmodel->jobtypeid = $jobtypeid;
        $searchresultmodel->min_age = $min_age;
        $searchresultmodel->max_age = $max_age;
        $searchresultmodel->gender = $gender;


        //--------- CALCULATE AGE  ------------------------

        $min_age_date = date('Y-m-d',strtotime($searchresultmodel->min_age . 'years ago'));
        $max_age_date = date('Y-m-d',strtotime($searchresultmodel->max_age . 'years ago'));

        //--------------------------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $searchresultmodel->jobtypeid])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ])
                    ->andfilterWhere(['seeker.gender'=>$searchresultmodel->gender])
                    ->andFilterWhere(['<=','seeker.dob',$min_age_date])
                    ->andFilterWhere(['>=','seeker.dob',$max_age_date])

            ,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);

        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;


            //----------------- Get Bookmark -----------------------


        $bookmark_seeker = new BookmarkSeeker();
        if($bookmark_seeker->getBookmark($provider_id,$seeker_id)==null) {
            $bookmark_seeker->provider_id = $provider_id;
            $bookmark_seeker->seeker_id = $seeker_id;
            $bookmark_seeker->job_type_id = $jobtypeid;
            $bookmark_seeker->save();
        }

       // return $this->redirect(Yii::$app->request->referrer);
        return $this->render('prodashsearch', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,
            ]);

    }

    /**
     * Bookmark Seeker
     */

    public function actionUnbookmarkseeker($provider_id,
                                           $seeker_id,
                                           $address,
                                           $jobtypeid,
                                           $min_age,
                                           $max_age,
                                           $gender){



        //----------------- Searh Result Page -----------------------

        $searchresultmodel = new SeekerSearchForm();
        $searchresultmodel->address = $address;
        $searchresultmodel->jobtypeid = $jobtypeid;
        $searchresultmodel->min_age = $min_age;
        $searchresultmodel->max_age = $max_age;
        $searchresultmodel->gender = $gender;


        //--------- CALCULATE AGE  ------------------------

        $min_age_date = date('Y-m-d',strtotime($searchresultmodel->min_age . 'years ago'));
        $max_age_date = date('Y-m-d',strtotime($searchresultmodel->max_age . 'years ago'));

        //--------------------------------------------------

        $model = new ActiveDataProvider([
            'query' =>
                Seeker::find()
                    ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                    ->where(['seeker_job_type.job_type_id' => $searchresultmodel->jobtypeid])
                    ->AndWhere(['like',
                        'seeker.address',
                        ['seeker.address' => $searchresultmodel->address]
                    ])
                    ->andfilterWhere(['seeker.gender'=>$searchresultmodel->gender])
                    ->andFilterWhere(['<=','seeker.dob',$min_age_date])
                    ->andFilterWhere(['>=','seeker.dob',$max_age_date])

            ,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);

        if($searchresultmodel->jobtypeid!= null)
            $searchjob = JobType::findOne(['job_type_id'=>$searchresultmodel->jobtypeid])->title;


        //----------------- Searh Result Page -----------------------


        $bookmark_seeker = new BookmarkSeeker();
        if($bookmark_seeker->getBookmark($provider_id,$seeker_id)!=null)
            $bookmark_seeker = $bookmark_seeker->getBookmark($provider_id,$seeker_id);
       $bookmark_seeker->delete();



      //  return $this->redirect(Yii::$app->request->referrer);
        return $this->render('prodashsearch', [
            'model' => $model,
            'searchresultmodel' => $searchresultmodel,
            'searchjob'=> $searchjob,
        ]);

    }

    /**
    *
    */


    /**
     * Finds the Provider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Provider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */



    protected function findModel($id)
    {
        if (($model = Provider::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
