<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Response;
use yii\web\Controller;

use app\models\TestForm;

class FormController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->post(), '')) {
                return null;
            }

            Yii::$app->response->statusCode = 400;
            return ['errors' => $model->firstErrors];
        }

        return $this->render('login', compact('model'));
    }

    public function actionForm()
    {
        $model = new TestForm();
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->bodyParams, '') && $model->validate()) {
                return null;
            }

            Yii::$app->response->statusCode = 400;
            return ['errors' => $model->firstErrors];
        }

        return $this->render('form', compact('model'));
    }

    public function actionPrefilledForm()
    {
        $model = new TestForm();
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($model->load(Yii::$app->request->bodyParams, '') && $model->validate()) {
                return null;
            }

            Yii::$app->response->statusCode = 400;
            return ['errors' => $model->firstErrors];
        }

        return $this->render('prefilled-form', compact('model'));
    }

    public function actionFormData()
    {
        $model = new TestForm([
            'name' => 'John',
            'surname' => 'Smith',
            'age' => '35',
            'email' => 'john.smith@mail.com',
            'phone' => '1234567890'
        ]);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $model;
    }

    public function actionVegetables()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return  [
            ['name' => 'Pepperoni', 'color' => 'Red, green or yellow'],
            ['name' => 'Carrot', 'color' => 'Orange'],
            ['name' => 'Zucchini', 'color' => 'Dark green']
        ];
    }
}