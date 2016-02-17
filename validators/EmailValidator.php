<?php

namespace undefinedstudio\yii2\angularform\validators;

/**
 *  @property \yii\validators\EmailValidator $originalValidator
 */
class EmailValidator extends AngularBuiltInValidator
{
    public $directive = 'us-email';

    public function messages()
    {
        return [
            'message' => $this->originalValidator->message
        ];
    }

    public function validators()
    {
        return [
            'message' => 'usEmail',
        ];
    }
}
