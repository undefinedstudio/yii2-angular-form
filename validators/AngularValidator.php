<?php

namespace undefinedstudio\yii2\angularform\validators;

use Yii;
use yii\base\Model;
use yii\validators\Validator;

use undefinedstudio\yii2\angularform\Html;

class AngularValidator extends Validator implements AngularValidatorInterface
{
    public $directive;

    public function messages()
    {
        return [
            'message' => $this->message
        ];
    }

    public function params()
    {
        return [];
    }

    public function validators()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function renderValidator($model, $attribute)
    {
        $validators = $this->validators();

        $messages = [];
        foreach($this->prepareMessages($model, $attribute) as $name => $message) {
            $validate = isset($validators[$name]) ? $validators[$name] : $this->directive;
            $messages[] = Html::tag('message', $message, compact('name', 'validate'));
        }

        return Html::tag('validator', implode("\n", $messages), [
            'target' => Html::getInputName($model, $attribute)
        ]);
    }

    /**
     * @param Model $model
     * @param string $attribute
     * @return array Prepared messages
     */
    public function prepareMessages($model, $attribute)
    {
        $params = array_merge($this->params(), [
            'attribute' => $model->getAttributeLabel($attribute)
        ]);

        return array_map(function($message) use ($params) {
            return Yii::t('validators', $message, $params);
        }, $this->messages());
    }

    /**
     * @param Model $model
     * @param string $attribute
     * @return AngularValidator[]
     */
    public static function getAngularValidators($model, $attribute)
    {
        $validators = $model->getActiveValidators($attribute);
        foreach($validators as $i => $validator) {
            // Try to get wrapper if built-in validator
            if (!($validator instanceof AngularValidatorInterface)) {
                $validators[$i] = AngularBuiltInValidator::createFromBuiltIn($validator);

                // If validator is not supported by angular, skip
                if ($validators[$i] == null) {
                    unset($validators[$i]);
                }
            }
        }

        return $validators;
    }
}
