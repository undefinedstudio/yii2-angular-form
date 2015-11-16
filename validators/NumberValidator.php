<?php

namespace undefinedstudio\yii2\angularform\validators;

/**
 *  @property \yii\validators\NumberValidator $originalValidator
 */
class NumberValidator extends AngularBuiltInValidator
{
    public $directive = 'us-number';

    public function messages()
    {
        $messages = [
            'message' => $this->originalValidator->message,
            'tooSmall' => $this->originalValidator->tooSmall,
            'tooBig' => $this->originalValidator->tooBig
        ];

        return $messages;
    }

    public function validators()
    {
        return [
            'message' => 'usNumber',
            'tooSmall' => 'usMinNumber',
            'tooBig' => 'usMaxNumber'
        ];
    }

    public function params()
    {
        return [
            'us-min' => $this->originalValidator->min,
            'us-max' => $this->originalValidator->max,
            'us-integer' => $this->originalValidator->integerOnly
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
