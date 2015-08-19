<?php

namespace undefinedstudio\yii2\angularform\validators;

class RequiredValidator extends AngularBuiltInValidator
{
    public $directive = 'required';

    public function messages()
    {
        return [
            'message' => $this->originalValidator->message
        ];
    }
}
