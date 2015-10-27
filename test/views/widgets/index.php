<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Yii2 Angular Widgets';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii2 Angular Widgets</h1>

        <p class="lead">Angular widgets compatible with AngularForm.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>MdAutocomplete</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?= Html::a('Demo &raquo;', ['/widgets/md-autocomplete'], ['class' => 'btn btn-default']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>MdChips</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?= Html::a('Demo &raquo;', ['/widgets/md-chips'], ['class' => 'btn btn-default']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Form</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?= Html::a('Demo &raquo;', ['/widgets/form'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>

    </div>
</div>