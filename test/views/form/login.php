<?php

use app\models\LoginForm;
use undefinedstudio\yii2\angularform\AngularForm;

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this  */
/** @var LoginForm $model */

$this->title = "Login";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login" ng-controller="LoginController">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = AngularForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
        'model' => $model,
        'ngSubmit' => 'login()'
    ]); ?>

        <?= $form->field('username') ?>

        <?= $form->field('password')->passwordInput() ?>

        <?= $form->field('rememberMe')->checkbox() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php AngularForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>