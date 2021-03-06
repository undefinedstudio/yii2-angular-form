<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;

use app\models\TestForm;
use app\models\MdAutocompleteForm;
use app\models\MdChipsForm;

class WidgetsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
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

    public function actionMdAutocomplete()
    {
        $model = new MdAutocompleteForm();
        return $this->render('md-autocomplete', [
            'model' => $model,
        ]);
    }

    public function actionMdChips()
    {
        $model = new MdChipsForm();
        return $this->render('md-chips', [
            'model' => $model,
        ]);
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