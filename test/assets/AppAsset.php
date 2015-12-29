<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/app';

    public $css = [
        'sass/site.css'
    ];

    public $js = [
        'js/app.js',
        'js/FormController.js',
        'js/PrefilledFormController.js',
        'js/LoginController.js',
        'js/MdAutocompleteController.js',
        'js/MdChipsController.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

        'undefinedstudio\yii2\angular\AngularAsset',
        'undefinedstudio\yii2\angular\AngularAnimateAsset',
        'undefinedstudio\yii2\angular\AngularMaterialAsset',
        'undefinedstudio\yii2\angular\AngularMessagesAsset',
        'undefinedstudio\yii2\angular\AngularRouteAsset',
        'undefinedstudio\yii2\angular\AngularResourceAsset',

        'undefinedstudio\yii2\angularform\AngularFormAsset'
    ];
}
