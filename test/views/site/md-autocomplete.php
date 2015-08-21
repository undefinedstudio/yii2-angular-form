<?php

use app\models\MdAutocompleteForm;

use undefinedstudio\yii2\angularform\AngularForm;
use undefinedstudio\yii2\angularwidgets\MdAutocomplete;

use yii\helpers\Html;

/** @var yii\web\View $this  */
/** @var MdAutocompleteForm $model */

$this->title = "MdAutocomplete";
$this->params['breadcrumbs'][] = $this->title;

?>
<div ng-controller="MdAutocompleteController">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = AngularForm::begin([
        'ngSubmit' => 'submit()'
    ]) ?>

        <?= $form->field($model, 'fruit')->widget(MdAutocomplete::className(), [
            'items' => 'fruit in searchFruit({searchText})',
            'itemText' => 'fruit.name',
            'placeholder' => 'What is your favorite fruit?',
            'itemTemplate' => Html::tag('span', '{{fruit.name}} ({{fruit.color}})')
        ]) ?>

        <?= $form->field($model, 'vegetable')->widget(MdAutocomplete::className(), [
            'items' => 'vegetable in searchVegetable({searchText})',
            'itemText' => 'vegetable.name',
            'placeholder' => 'What is your favorite vegetable?',
            'itemTemplate' => Html::tag('span', '{{vegetable.name}} ({{vegetable.color}})')
        ]) ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>

    <?php AngularForm::end(); ?>
</div>