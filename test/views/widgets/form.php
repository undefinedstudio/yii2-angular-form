<?php

use yii\helpers\Html;

/** @var yii\web\View $this  */

$this->title = "Form";
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <form name="myForm">
        <p>Note that invalid styling only applies if invalid and dirty</p>
        <label>Favorite Number</label>
        <input name="myModel" ng-model="myModel" required>
        <div ng-messages="myForm.myModel.$error" ng-if="myForm.$dirty">
            <div ng-message="required">Il mio messagge</div>
        </div>
        <div ng-messages="myForm.campo.$error" ng-if="myForm.$dirty">
            <div
        </div>
    </form>

</div>