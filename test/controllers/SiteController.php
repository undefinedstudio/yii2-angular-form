<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\LoginForm;
use app\models\MdAutocompleteForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionMdAutocomplete()
    {
        $model = new MdAutocompleteForm();
        /*if ($model->load(Yii::$app->request->post())) {
            return $this->goBack();
        }*/
        return $this->render('md-autocomplete', [
            'model' => $model,
        ]);
    }

    public function actionVegetables()
    {
        // Simulate network delay
        sleep(1);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return  [
            ['name' => 'Pepperoni', 'color' => 'Red, green or yellow'],
            ['name' => 'Carrot', 'color' => 'Orange'],
            ['name' => 'Zucchini', 'color' => 'Dark green']
        ];
    }
}