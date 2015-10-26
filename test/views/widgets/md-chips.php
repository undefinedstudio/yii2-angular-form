<?php

use app\models\MdChipsForm;

use undefinedstudio\yii2\angularform\AngularForm;
use undefinedstudio\yii2\angularwidgets\MdAutocomplete;
use undefinedstudio\yii2\angularwidgets\MdChips;
use undefinedstudio\yii2\angularwidgets\MdAutocompleteChips;

use yii\helpers\Html;

/** @var yii\web\View $this  */
/** @var MdChipsForm $model */

$this->title = "MdChips";
$this->params['breadcrumbs'][] = $this->title;

?>
<div ng-controller="MdChipsController">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = AngularForm::begin([
        'ngSubmit' => 'submit()'
    ]) ?>

        <?= $form->field($model, 'words')->widget(MdChips::className(), [
            'placeholder' => 'What are your favorite words?'
        ]) ?>

        <?= $form->field($model, 'vegetables')->widget(MdAutocompleteChips::className(), [
            'items' => 'vegetable in searchVegetable({searchText})',
            'itemText' => 'vegetable.name',
            'placeholder' => 'What are your favorite vegetables?',
            'itemTemplate' => '{{vegetable.name}} - {{vegetable.color}}',
            'chipTemplate' => '{{$chip.name}}'
        ]) ?>

        <?php /*echo MdAutocomplete::widget([
            'items' => 'vegetable in searchVegetable({searchText})',
            'itemText' => 'vegetable.name',
            'placeholder' => 'What is your favorite vegetable?',
            'itemTemplate' => Html::tag('span', '{{vegetable.name}} ({{vegetable.color}})')
        ])*/ ?>

        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

    <?php AngularForm::end(); ?>
</div>