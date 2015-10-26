<?php

namespace undefinedstudio\yii2\angularform\validators;

use undefinedstudio\yii2\angularform\Html;
use Yii;
use yii\base\Exception;
use yii\validators\Validator;

class AngularBuiltInValidator extends AngularValidator
{
    public static $defaultValidators = [
        'yii\validators\RequiredValidator' => 'undefinedstudio\yii2\angularform\validators\RequiredValidator',
        'yii\validators\StringValidator' => 'undefinedstudio\yii2\angularform\validators\StringValidator'
    ];

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

        return new static::$defaultValidators[$className]([
            'originalValidator' => $validator
        ]);
    }
}
