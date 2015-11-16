<?php

namespace undefinedstudio\yii2\angularform\validators;

use Yii;
use yii\validators\Validator;

class AngularBuiltInValidator extends AngularValidator
{
    public static $defaultValidators = [
        'yii\validators\RequiredValidator' => 'undefinedstudio\yii2\angularform\validators\RequiredValidator',
        'yii\validators\StringValidator' => 'undefinedstudio\yii2\angularform\validators\StringValidator',
        'yii\validators\NumberValidator' => 'undefinedstudio\yii2\angularform\validators\NumberValidator'
    ];

    /** @var Validator */
    public $originalValidator;

    /**
     * @param \yii\validators\Validator $validator
     * @return AngularBuiltInValidator|null
     */
    public static function createFromBuiltIn($validator)
    {
        $className = $validator->className();
        if (!isset(static::$defaultValidators[$className])) {
            return null;
        }

        //TODO: merge all properties from base Validator
        return new static::$defaultValidators[$className]([
            'attributes' => $validator->attributes,
            'on' => $validator->on,
            'except' => $validator->except,
            'skipOnError' => $validator->skipOnError,
            'skipOnEmpty' => $validator->skipOnEmpty,

            'originalValidator' => $validator
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function validateValue($value)
    {
        return $this->originalValidator->validateValue($value);
    }
}
