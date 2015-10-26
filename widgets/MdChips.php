<?php

namespace undefinedstudio\yii2\angularwidgets;

use undefinedstudio\yii2\angularform\Html;
use yii\helpers\ArrayHelper;

class MdChips extends AngularWidget
{
    public $options = [];
    public $chipTemplate;

    public $placeholder;
    public $bufferModel;

    public $inputOptions = [];

    public function run()
    {
        $this->inputOptions = ArrayHelper::merge([
            'placeholder' => !empty($this->placeholder) ? $this->placeholder : null,
            'ng-model' => !empty($this->bufferModel) ? $this->bufferModel : null
        ], $this->inputOptions);

        $chipTemplate = $this->chipTemplate ? Html::tag('md-chip-template', $this->chipTemplate) : '';

        if ($this->model && $this->attribute) {
            echo Html::activeHiddenInput($this->model, $this->attribute);
        }

        $content = Html::textInput(null, null, $this->inputOptions);
        echo Html::tag('md-chips', $content . $chipTemplate, $this->options);
    }
}
