<?php

namespace frontend\modules\api\controllers;


use yii\web\Controller;
use frontend\models\Apitest;
/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    public $enableCsrfValidation= false;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return "Hello Api in Modules";
    }
/*
    public function actionHello(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $apitest = new Apitest();
        // $apitest->scenario = Apitest::SCENARIO_CREATE;

        $apitest->attributes = \Yii::$app->request->get();
        return ['status'=>true];
    }
*/





    public function actionCreate(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $apitest = new Apitest();
       // $apitest->scenario = Apitest::SCENARIO_CREATE;

        $apitest->attributes = \Yii::$app->request->get();
      //  $apitest->name = 'Shema';
      //  $apitest->model = 'Version1';
        if($apitest->validate()) {
           $apitest->save();
            return ['status' => true];

        }else{
            return ['status'=>false,'data'=>$apitest->getErrors()];
        }
    }


}
