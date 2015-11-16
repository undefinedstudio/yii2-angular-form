<?php

namespace undefinedstudio\yii2\angularform\validators;

/**
 * This should not be added as a validator in the model
 * It serves just as a placeholder to render server error validations.
 * {@inheritdoc}
 */
class ServerValidator extends AngularValidator
{
    public $directive = 'us-server';

    public function messages()
    {
        return [
            'message' => ''
        ];
    }

    public function validators()
    {
        return [
            'message' => 'usServer',
        ];
    }
}
