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
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = AngularForm::begin([
        'action' => Url::to(['/site/post-test']),
    ]) ?>

    <p>Note that invalid styling only applies if invalid and dirty</p>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'age') ?>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'phone') ?>

    <?php AngularForm::end() ?>

</div>