<?php

namespace undefinedstudio\yii2\angularwidgets;

use undefinedstudio\yii2\angularform\Html;
use yii\base\Widget;

class AngularWidget extends Widget
{
    public $model;
    public $attribute;

    public $options = [];

    public $modelAttribute = 'ng-model';

    public function init()
    {
        parent::init();
        if ($this->model && $this->attribute) {
            $this->options[$this->modelAttribute] = Html::getInputNgModel($this->model, $this->attribute);
        }
    }
}
