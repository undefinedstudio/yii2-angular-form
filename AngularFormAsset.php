<?php

namespace undefinedstudio\yii2\angularform;

use yii\web\AssetBundle;

class AngularFormAsset extends AssetBundle
{
    public $css = [
        'sass/site.css'
    ];

    public $js = [
        'js/yii2-angular-form.js',
        'js/validator.js',
        'js/usString.js',
        'js/usNumber.js',
        'js/usArray.js',

        'js/ngValue.js',
        'js/us-messages.js'
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets/';
        parent::init();
    }

    public $depends = [
        'undefinedstudio\yii2\angular\AngularAsset'
    ];
}
