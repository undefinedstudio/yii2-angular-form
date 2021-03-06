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
        'js/form.js',

        'js/usString.js',
        'js/usNumber.js',
        'js/usArray.js',
        'js/usEmail.js',
        'js/usMatch.js',
        'js/usCompare.js',

        'js/ngValue.js',
        'js/usServerMessage.js',
        'js/usModelData.js'
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
