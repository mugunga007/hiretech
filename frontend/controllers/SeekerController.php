<?php

namespace frontend\controllers;

use frontend\models\JobType;
use frontend\models\SeekerSearchForm;
use frontend\models\SeekerUpdateForm;
use frontend\models\SeekerUpdatePicture;
use frontend\models\SelectedSeeker;
use Yii;
use frontend\models\Seeker;
use frontend\models\SeekerSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\models\SignupForm;
use yii\web\UploadedFile;
use frontend\models\SeekerJobType;
use DateTime;
use yii\filters\AccessControl;
use yii\db\Exception;
use frontend\models\SeekerNotification;
use common\models\User;
use frontend\models\ProviderNotification;
use common\models\LoginForm;



/**
 * SeekerController implements the CRUD actions for Seeker model.
 */
class SeekerController extends Controller
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
                ]
                ],
                'access'=>[
                    'except'=>['create','login'],
                    'class'=>AccessControl::className(),
                    'rules'=>[
                        [
                            'allow'=>true,
                            'roles'=>['@']
                        ],


                    ]

            ],
        ];
    }

    /**
     * Lists all Seeker models.
     * @return mixed
     */

    /*
    public function actionIndex()
    {
        $searchModel = new SeekerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
*/



    /**
     * Seeker Login
     */



    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userlog = User::findOne(['username' => $model->username]);
            if ($userlog->role == 'seeker') {

                $seeker_id = Yii::$app->user->identity->seeker->seeker_id;


                $model = new ActiveDataProvider([
                    'query' =>
                        SelectedSeeker::find()
                            ->where(['seeker_id' => $seeker_id])
                            ->andWhere(['status' => 'Confirmed']),
                    'pagination' => [
                        'pageSize' => 3,
                    ]

                ]);


                //  Yii::$app->runAction('/seeker/seekerdashboard',['model'=>$model]);


                return $this->render('/seeker/seekerdashboard', ['model' => $model]);
            }

        } else {

            return $this->render(
                '/seeker/login_seeker',

                [

                    'model' => $model,

                ]);


        }
    }
    /**
     *
     * Edit job types for a job seeker
     */

    public function actionEditjobtypes(){

         $seekerjobtypes = Yii::$app->user->identity->seeker->seekerJobTypes;
        // $seekerjobtypes = SeekerJobType::findAll(['seeker_id'=>Yii::$app->user->identity->seeker->seeker_id]);

        $job =JobType::find()
            ->where(['not in','job_type_id',
                ( new Query())
            ->select(['job_type_id'])
            ->from('seeker_job_type')
            ->where(['seeker_id'=>Yii::$app->user->identity->seeker->seeker_id])

            ])->all();

        return $this->render('addjobtype',['seekerjobtypes'=>$seekerjobtypes,'job'=>$job]);
    }

    /**
     * Update Jobtypes
     */

    public function actionUpdatejobtypes(){

        $seekerjobtypes = Yii::$app->user->identity->seeker->seekerJobTypes;
        // $seekerjobtypes = SeekerJobType::findAll(['seeker_id'=>Yii::$app->user->identity->seeker->seeker_id]);

        $job =JobType::find()
            ->where(['not in','job_type_id',
                ( new Query())
                    ->select(['job_type_id'])
                    ->from('seeker_job_type')
                    ->where(['seeker_id'=>Yii::$app->user->identity->seeker->seeker_id])

            ])->all();

        return $this->render('updatejobtypes',['seekerjobtypes'=>$seekerjobtypes,'job'=>$job]);
    }

    /**
     * Delete job type
     *
     */
    public function actionDeletejob($id){

        $this->findSeekerJobTypeModel($id)->delete();

            return $this->redirect(Yii::$app->request->referrer);

    }

    /**
     *
     * Add job type to seeker's job types
     */

    public function actionAddjobtype($jobtypeid,$seekerid){
        $job = JobType::find()->all();
        $seekerjobtypes = Yii::$app->user->identity->seeker->seekerJobTypes;
        $seekerjobtype = new SeekerJobType();
        $seekerjobtype->seeker_id = $seekerid;
        $seekerjobtype->job_type_id = $jobtypeid;
        if($seekerjobtype->save()){
            return $this->redirect('editjobtypes');
        }else
            return $this->render('addjobtype',['seekerjobtypes'=>$seekerjobtypes,'job'=>$job]);
    }


    /**
     * Displays a single Seeker model.
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
     * Creates a new Seeker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seeker();
        $newuser = new SignupForm();


        if ($model->load(Yii::$app->request->post()) ) {
            $newuser->email = $model->email;
            $newuser->password = $model->password;
            $newuser->username = $model->email;
            $newuser->role = 'seeker';
        $model->dob = date('Y-m-d',strtotime($model->dob));

                $picture = UploadedFile::getInstance($model, 'picture');
                $picture->saveAs('img/upload/'.$model->email.'pic.'.$picture->extension);
                $model->picture = $model->email.'pic.'. $picture->extension;

            if ( $model->save() && $user = $newuser->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                   $seekerjobtypes = Yii::$app->user->identity->seeker->seekerJobTypes;
                    return $this->redirect(['editjobtypes', 'id' => $model->seeker_id,
                      //  'seekerjobtypes'=>$seekerjobtypes,
                    ]);
                }
            }

        }


        /*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->seeker_id]);
        }
        */

        return $this->render('create', [
            'model' => $model,

        ]);
    }


    /**
     * Updates an existing Seeker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /*
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->seeker_id]);
        }

        return $this->render('/seeker/update', [
            'model' => $model,
        ]);
    }
    */

    /**
     * * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
     */

    public function actionMyupdate($seeker_id)
    {

       // $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $model = SeekerUpdateForm::findOne($seeker_id);
        $update_picture_model = new SeekerUpdatePicture();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success',
                'Your Profile have been Updated Successfully <b><i class="fa fa-user-check"></i></b>');

            return $this->render('seekerprofile', ['model' => $model,
                'update_picture_model'=>$update_picture_model,]);
        }

        return $this->render('/seeker/edit_seeker', [
            'model' => $model,
            'update_picture_model'=>$update_picture_model,
            ''
        ]);
    }

    /**
     * * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
     */

    public function actionUpdatepicture()
    {

        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
      //  $seeker = Seeker::findOne(['seeker_id'=>$seeker_id]);
        // modelupdate to load form in the modal
       // $model = new SeekerUpdatePicture();

        // model to get user's email to rename the uploaded file
        $model = SeekerUpdatePicture::findOne($seeker_id);
       if ($model->load(Yii::$app->request->post())) {
           $picture = UploadedFile::getInstance($model, 'picture');
           $picture->saveAs('img/upload/' . $model->email . 'pic.' . $picture->extension);
           $model->picture = $model->email . 'pic.' . $picture->extension;

         //  $seeker->picture = $model->picture;
        //   $seeker->save();

           $model->save();
               Yii::$app->getSession()->setFlash('success',
                   'Your Picture have been Updated Successfully, It will be Changed in a while <b><i class="fa fa-user-check"></i></b>');

               return $this->render('seekerprofile', ['model' => $model,
                   'update_picture_model'=>$model]);

       }else

           return $this->render('update_picture', ['model' => $model]);
    }



    /**
     * Deletes an existing Seeker model.
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

    /*
    public function actionSeekerslist(){
        $searchModel = new SeekerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('seekerslist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    */

    /**
     * Search result of seekers
     */
/*
    public function actionSearchresult($address){
        $searchresultmodel = new SeekerSearchForm();
        $model = new ActiveDataProvider([
            'query'=> Seeker::find()
                ->where(['address'=>$address]),
            'pagination'=>[
                'pageSize'=>3
            ]
        ]);
       // $seekerjobtypes = $model->seeker_id;

        return $this->render('searchresult',['model'=>$model,
          'searchresultmodel'=>$searchresultmodel,
          //  'seekerjobtypes'=>$seekerjobtypes
        ]);

    }
*/

    public function actionSearchresult()
    {
        $searchresultmodel = new SeekerSearchForm();

       // $searchresultmodel->load(Yii::$app->request->post());

        $model = $searchresultmodel->searchformresult(Yii::$app->request->queryParams);

          // $model = $searchresultmodel->searchformresult($searchresultmodel->load(Yii::$app->request->get()));

        /*
            $model = new ActiveDataProvider([
                'query'=>
                    Seeker::find()
                        ->join('join','seeker_job_type','seeker_job_type.seeker_id = seeker.seeker_id')
                        ->where(['seeker_job_type.job_type_id'=>$searchresultmodel->jobtypeid])
                        ->AndWhere(['like',
                            'seeker.address',
                            ['seeker.address'=>$searchresultmodel->address]
                        ]),
                'pagination'=>[
                    'pageSize'=>1
                ]



            ]);
*/
            return $this->render('searchresult', [
                'model' => $model,
                'searchresultmodel' => $searchresultmodel,

            ]);


}

public function actionSearchseekerss()
{
    $searchresultmodel = new SeekerSearchForm();
   // $model = null;

  //  $searchresultmodel->load(Yii::$app->request->post());
    $searchresultmodel->load(Yii::$app->request->queryParams);

       $model = new ActiveDataProvider([
           'query' =>
               Seeker::find()
                   ->join('join', 'seeker_job_type', 'seeker_job_type.seeker_id = seeker.seeker_id')
                   ->where(['seeker_job_type.job_type_id' => $searchresultmodel->jobtypeid])
                   ->AndWhere(['like',
                       'seeker.address',
                       ['seeker.address' => $searchresultmodel->address]
                   ]),
           'pagination' => [
               'pageSize' => 1
           ]
       ]);

       return $this->render('searchresult', [
           'model' => $model,
           'searchresultmodel' => $searchresultmodel,

       ]);

}

    /*
    public function actionSeekerlist(){

        return $this->render('_seeker');
    }
    */

    public function actionSeekerprofile(){
        /*
        $model = Seeker::findOne(['email'=>Yii::$app->user->identity->username]);
        $seekerjobtypes = Yii::$app->user->identity->seeker->seekerJobTypes;
        */
        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $model = new ActiveDataProvider([
            'query'=>
                SelectedSeeker::find()
                    ->where(['seeker_id'=>$seeker_id])
                    ->andWhere(['status'=>'Confirmed']),
            'pagination'=>[
                'pageSize'=>3,
            ]
        ]);

        Yii::$app->getSession()->setFlash('success',
            'Your Profile have been created Successfully <b><i class="far fa-check-circle"></i></b>');

        return $this->render('seekerdashboard',
            ['model'=>$model]
        );

      //  return $this->render('seekerprofile',['model'=>$model,'seekerjobtypes'=>$seekerjobtypes]);
    }

    /**
     * Seeker View Profile
     */

    public function actionMyprofile(){
       $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $modelupdate = SeekerUpdateForm::findOne($seeker_id);
        $update_picture_model = new SeekerUpdatePicture();
       $model = Seeker::findOne(['seeker_id'=>$seeker_id]);

       $seeker_job_types = new SeekerJobType();
       return $this->render('seekerprofile',[
           'model'=>$model,
          'modelupdate'=>$modelupdate,
           'update_picture_model'=>$update_picture_model,
       ]);
    }



    /**
     *
     * Seeker layout
     */

    public function actionSeekerdashboard(){
        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $model = new ActiveDataProvider([
            'query'=>
                SelectedSeeker::find()
                    ->where(['seeker_id'=>$seeker_id])
                    ->andWhere(['status'=>'Confirmed']),
            'pagination'=>[
                'pageSize'=>3,
            ]
        ]);
        return $this->render('seekerdashboard',
            ['model'=>$model]
        );
    }

    /**
     * Seeker accepts offer
     */

    /**
     * Unselect Seeker
     */


    public function actionSeekeracceptoffer($selected_seeker_id){

        $today = new DateTime();
        $todayString = $today->format('Y-m-d H:i:s');
        $selected = SelectedSeeker::findOne(['selected_seeker_id'=>$selected_seeker_id]);
        $selected->status = 'Accepted';
        $selected->seeker_response_time = $todayString;
        $selected->save();
        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $model = new ActiveDataProvider([
            'query'=>
                SelectedSeeker::find()
                    ->where(['seeker_id'=>$seeker_id])
                    ->andWhere(['status'=>'Confirmed']),
            'pagination'=>[
                'pageSize'=>3,
            ]
        ]);
        //------------ Notify provider ------------------------------
        $seeker_email = Yii::$app->user->identity->seeker->email;
        $provider_notification = new ProviderNotification();
        $provider_notification->notify_provider($selected->provider_id,
           $provider_notification->accepted_message,
            'Accepted',
            $seeker_email);

        //----------------------------------



       return $this->render('seekerdashboard',
           ['model'=>$model]);


    }

    /**
     *
     * Seeker denies offer
     */
    public function actionSeekerdenyoffer($selected_seeker_id){

        $today = new DateTime();
        $todayString = $today->format('Y-m-d H:i:s');
        $selected = SelectedSeeker::findOne(['selected_seeker_id'=>$selected_seeker_id]);
        $selected->status = 'Denied';
        $selected->seeker_response_time = $todayString;
        $selected->save();
        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;

        $model = new ActiveDataProvider([
            'query'=>
                SelectedSeeker::find()
                    ->where(['seeker_id'=>$seeker_id])
                    ->andWhere(['status'=>'Confirmed']),
            'pagination'=>[
                'pageSize'=>3,
            ]
        ]);
        /*
        return $this->render('seekerdashboard',[
            'model'=>$model
        ]);
        */

        return $this->redirect(Yii::$app->request->referrer);


    }

    /**
     *
     * Seeker views all offers
     */

    public function actionSeekeralloffers(){
        /*
        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $model = new ActiveDataProvider([
            'query'=>
                SelectedSeeker::find()
                    ->where(['seeker_id'=>$seeker_id])
                    ->andWhere(['<>','status','Selected']),
            'pagination'=>[
                'pageSize'=>3,
            ]
        ]);
        */

        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
        $model = new ActiveDataProvider([
            'query'=>
                SelectedSeeker::find()
                    ->where(['seeker_id'=>$seeker_id])
                    ->andWhere(['<>','status','Selected'])
            ->orderBy([
                'confirmation_time'=>SORT_DESC
            ]),
            'pagination'=>[
                'pageSize'=>3,
            ]
        ]);
        return $this->render('seekeralloffers',
            ['model'=>$model]
        );
    }

    /**
     *
     * Update job type to seeker's job types
     */

    public function actionUpdatejobtypessubmit($jobtypeid,$seekerid){
        $job = JobType::find()->all();
        $seekerjobtypes = Yii::$app->user->identity->seeker->seekerJobTypes;
        $seekerjobtype = new SeekerJobType();
        $seekerjobtype->seeker_id = $seekerid;
        $seekerjobtype->job_type_id = $jobtypeid;
        $seekerjobtype->save();
            return $this->redirect(Yii::$app->request->referrer);

    }

    /**
     * show notifications page
     */

    public function actionNotifications(){

        $seeker_id = Yii::$app->user->identity->seeker->seeker_id;
          $seeker_notification  = new ActiveDataProvider([
              'query'=> SeekerNotification::find()
            ->where(['seeker_id'=>$seeker_id])
                  ->orderBy([
                      'time'=>SORT_DESC,
                  ])


          ]);

          SeekerNotification::updateAll(['status'=>'read'],['status'=>'unread']);

          return $this->render('notifications',[
              'model'=>$seeker_notification,
          ]);
    }




    /**
     * Finds the Seeker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seeker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seeker::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findSeekerJobTypeModel($id)
    {
        if (($model = SeekerJobType::findOne([$id])) !== null)
            return $model;


    //    throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
