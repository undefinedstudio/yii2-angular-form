<?php

namespace undefinedstudio\yii2\angularform\validators;

class StringValidator extends AngularBuiltInValidator
{
    public $directive = 'us-string';
    public $modelDirective = 'us-string';

    public function messages()
    {
        return [
            'message' => $this->originalValidator->message,
            'tooShort' => $this->originalValidator->tooShort,
            'tooLong' => $this->originalValidator->tooLong
        ];
    }

    public function params()
    {
        return [
            'minlength' => $this->originalValidator->min,
            'maxlength' => $this->originalValidator->max
        ];
    }
}
