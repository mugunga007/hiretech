<?php
namespace frontend\controllers;

use common\models\User;
use frontend\models\Provider;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use frontend\models\SeekerSearchForm;
use frontend\models\SelectedSeeker;
use yii\data\ActiveDataProvider;
use frontend\models\ProviderJob;
use frontend\models\Seeker;
use yii\web\UserEvent;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /*
        $model = new LoginForm();
        return $this->render('index',['model'=>$model]);
        */

        /*
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        */

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userlog = User::findOne(['username' => $model->username]);
            if ($userlog->role == 'seeker') {

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


              //  Yii::$app->runAction('/seeker/seekerdashboard',['model'=>$model]);


            return $this->render('/seeker/seekerdashboard',['model'=>$model]);


            }

            if($userlog->role == 'provider') {
                $provider_id = Yii::$app->user->identity->provider->provider_id;
                $provider_job_count = ProviderJob::find()->where(['provider_id'=>$provider_id])
                ->count();





                $provider_id = Yii::$app->user->identity->provider->provider_id;
                $provider_job = new ActiveDataProvider([
                    'query' => ProviderJob::find()
                        ->where(['provider_id'=>$provider_id])
                        ->andWhere(['>=','status',3])
                ]);




                return  $this->render(
                    '/provider/providerdashboard',
                    //'../provider-job/_providerjob',
                    [
                        'provider_job'=>$provider_job,
                        'model'=>$model,

                        'provider_job_count'=>$provider_job_count,
                    ]);



            }
           if($userlog->role == 'user'){
               return $this->render('/site/about');
           }
            /*
            if(Yii::$app->user->identity->role == 'provider'){
                return $this->render('/provider/view',['model'=>$this->findModelProvider(Yii::$app->user->identity->email)]);
            }elseif (Yii::$app->user->identity->role == 'seeker'){

                return $this->render('/seeker/view',['model'=>$this->findModelSeeker(Yii::$app->user->identity->email)]);
            }
*/
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Finds the Provider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Provider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModelProvider($email)
    {
        if (($model = Provider::findOne([
            'email'=>$email
            ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     *
     * Seeker profile view after login
     */

    /**
     * Finds the Seeker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seeker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelSeeker($email)
    {
        if (($model = Seeker::findOne([
                'email'=>$email
            ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new LoginForm();
     /*
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        $userlog = User::findOne(['username'=>$model->username]);
            if($userlog->role == 'seeker')
                return $this->render('/seeker/view',['model'=>$this->findModelSeeker($model->username)]);
            if($userlog->role == 'provider')
                return $this->render('/provider/view',['model'=>$this->findModelProvider(Yii::$app->user->identity->email)]);

            return $this->goBack();
        } else {
            $model->password = '';
*/
            return $this->render('login', [
                'model' => $model,
            ]);
  //      }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = new LoginForm();
        return $this->render('about',['model'=>$model]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    /**
     *
     * Testing file
     */
/*
    public function actionHomepage(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userlog = User::findOne(['username'=>$model->username]);
            if($userlog->role == 'seeker')
                return $this->render('/seeker/view',['model'=>$this->findModelSeeker($model->username)]);
            if($userlog->role == 'provider')
                return $this->render('/provider/view',['model'=>$this->findModelProvider(Yii::$app->user->identity->email)]);
            /*
            if(Yii::$app->user->identity->role == 'provider'){
                return $this->render('/provider/view',['model'=>$this->findModelProvider(Yii::$app->user->identity->email)]);
            }elseif (Yii::$app->user->identity->role == 'seeker'){

                return $this->render('/seeker/view',['model'=>$this->findModelSeeker(Yii::$app->user->identity->email)]);
            }

            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('homepage', [
                'model' => $model,
            ]);
        }
    }
*/


    /**
     *
     * homepage for testing design

    public function actionHomepage(){
        $model = new LoginForm();
        return $this->render('homepage',['model'=>$model]);
    }
     *
     */

}
