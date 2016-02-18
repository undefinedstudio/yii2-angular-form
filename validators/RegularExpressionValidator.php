<?php

namespace undefinedstudio\yii2\angularform\validators;

/**
 *  @property \yii\validators\RegularExpressionValidator $originalValidator
 */
class RegularExpressionValidator extends AngularBuiltInValidator
{
    public $directive = 'us-match';

    public function messages()
    {
        return [
            'message' => $this->originalValidator->message
        ];
    }

    public function params()
    {
        $patternWrapper = substr($this->originalValidator->pattern, 0, 1);

        return [
            'us-pattern' => trim($this->originalValidator->pattern, $patternWrapper),
            'us-not' => $this->originalValidator->not
        ];
    }
}
