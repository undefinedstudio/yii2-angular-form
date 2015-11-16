<?php

namespace undefinedstudio\yii2\angularform\validators;

/**
 * @property \yii\validators\RequiredValidator $originalValidator
 */
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
