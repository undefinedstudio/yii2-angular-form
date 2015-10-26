<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;

use app\models\Form;
use app\models\MdAutocompleteForm;
use app\models\MdChipsForm;

class WidgetsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionForm()
    {
        return $this->render('form');
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