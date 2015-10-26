<?php

namespace undefinedstudio\yii2\angularform\validators;

class ArrayValidator extends AngularValidator
{
    public $directive = 'us-array';

    public $min;
    public $max;

    public $message = 'Must be array.';
    public $tooSmall = 'Too short.';
    public $tooBig = 'Too big';

    public function messages()
    {
        return [
            'message' => $this->message,
            'tooSmall' => $this->tooSmall,
            'tooBig' => $this->tooBig
        ];
    }

    public function validators()
    {
        return [
            'message' => 'usString',
            'tooSmall' => 'usArrayMin',
            'tooBig' => 'usArrayMax'
        ];
    }

    public function params()
    {
        return [
            'us-array-min' => $this->min,
            'us-array-max' => $this->max
        ];
    }
}
