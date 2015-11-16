<?php

namespace undefinedstudio\yii2\angularform\validators;

use yii\base\Model;

interface AngularValidatorInterface
{
    /**
     * @param Model $model
     * @param string $attribute
     * @return string Html content needed to render the validator client-side
     */
    public function renderValidator($model, $attribute);
}