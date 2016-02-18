<?php

namespace undefinedstudio\yii2\angularform\validators;

/**
 * @property \yii\validators\CompareValidator $originalValidator
 */
class CompareValidator extends AngularBuiltInValidator
{
    public $directive = 'us-compare';

    public function messages()
    {
        return [
            'message' => $this->originalValidator->message
        ];
    }

    public function params()
    {
        return [
            'us-compare-attribute' => $this->originalValidator->compareAttribute
        ];
    }
}
