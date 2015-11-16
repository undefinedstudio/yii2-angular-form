<?php

use app\models\TestForm;
use undefinedstudio\yii2\angularform\AngularForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this  */
/** @var TestForm $model  */

$this->title = "Form";
$this->params['breadcrumbs'][] = $this->title;

?>
<div ng-controller="FormController">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = AngularForm::begin([
        'ngSubmit' => 'submit()',
        'model' => $model
    ]) ?>

    <p>Note that invalid styling only applies if invalid and dirty</p>

    <?= $form->field('name') ?>
    <?= $form->field('surname') ?>

    <?= $form->field('age') ?>

    <?= $form->field('email') ?>
    <?= $form->field('phone') ?>

    <?= Html::submitButton() ?>

    <?php AngularForm::end() ?>

</div>