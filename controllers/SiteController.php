<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Users;


class SiteController extends Controller
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
                    'delete-user' => ['post'],
                    'add-user' => ['post']
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUsers() 
    {
        if(Yii::$app->request->isAjax){
            
            $users = Users::find()->all();
            $array_users = [];
            
            foreach ($users as $user){
                
                $array_users[] = [
                    $user->name, 
                    $user->city->name, 
                    $user->skills,
                    '<button title="Удалить" class="btn-delete-user" data-id="'.$user->id.'"><i class="glyphicon glyphicon-trash"></i></button>'
                    ];
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['data'=>$array_users];
        }
    }
    public function actionAddUser() 
    {
        if(Yii::$app->request->isAjax){
            $user = new Users();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $user->createUser();
        }
        
    }
    public function actionDeleteUser() 
    {
        if(Yii::$app->request->isAjax && $user_id = Yii::$app->request->post('user_id')){
            $user = Users::findOne($user_id);
            $user->delete();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return true;
        }
    }
}
