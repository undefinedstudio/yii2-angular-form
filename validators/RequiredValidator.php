<?php

namespace undefinedstudio\yii2\angularform\validators;

class RequiredValidator extends AngularBuiltInValidator
{
    public $directive = 'us-required';
    public $modelDirective = 'required';

    public function messages()
    {
        return [
            'message' => $this->originalValidator->message
        ];
    }
}
