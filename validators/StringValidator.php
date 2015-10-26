<?php

namespace undefinedstudio\yii2\angularform\validators;

class StringValidator extends AngularBuiltInValidator
{
    public $directive = 'us-string';

    public function messages()
    {
        $messages = [
            'message' => $this->originalValidator->message,
            'tooShort' => $this->originalValidator->tooShort,
            'tooLong' => $this->originalValidator->tooLong
        ];

        return $messages;
    }

    public function validators()
    {
        return [
            'message' => 'usString',
            'tooShort' => 'minlength',
            'tooLong' => 'maxlength'
        ];
    }

    public function params()
    {
        return [
            'ng-minlength' => $this->originalValidator->min,
            'ng-maxlength' => $this->originalValidator->max
        ];
    }

    public function messageParams()
    {
        return [
            'min' => $this->originalValidator->min,
            'max' => $this->originalValidator->max
        ];
    }
}
