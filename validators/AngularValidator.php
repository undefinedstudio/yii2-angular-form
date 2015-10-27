<?php

namespace undefinedstudio\yii2\angularform\validators;

use Yii;
use yii\base\Model;
use yii\validators\Validator;

use undefinedstudio\yii2\angularform\Html;

class AngularValidator extends Validator implements AngularValidatorInterface
{
    public $directive;

    /**
     * Message strings shown when validation fails.
     * The key is needed to associate each message to its validator in the validators() method.
     * The message can have parameters in the form of {parameter} with alphanumerical characters only
     * according to Yii2 I18N formatting, and those parameters will be evaluated by params()
     * or messageParams() if needed.
     * @return array
     */
    public function messages()
    {
        return [
            'message' => $this->message
        ];
    }

    /**
     * Defines the parameter values of directives and messages
     * @return array
     */
    public function params()
    {
        return [];
    }

    /**
     * Override this to name the message params differently from the directive ones
     * @return array
     */
    public function messageParams()
    {
        return $this->params();
    }

    /**
     * Maps each message to its trigger validator
     * e.g. when form.model.$error.required is true, the message
     * with key 'required' is shown
     * @return array
     */
    public function validators()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function renderValidator($model, $attribute, $formName)
    {
        $validators = $this->validators();

        $messages = [];
        foreach($this->prepareMessages($model, $attribute) as $name => $message) {
            $messages[] = Html::tag('div', $message, [
                'ng-message' => isset($validators[$name]) ? $validators[$name] : $this->directive
            ]);
        }

        $formNgModel = Html::getFormNgModel($model, $attribute, $formName);

        return Html::tag('div', implode("\n", $messages), [
            'ng-messages' => $formNgModel . '.$error',
            'ng-if' => $formNgModel . '.$dirty'
        ]);
    }

    /**
     * @param Model $model
     * @param string $attribute
     * @return array Prepared messages
     */
    public function prepareMessages($model, $attribute)
    {
        $params = array_merge($this->messageParams(), [
            'attribute' => $model->getAttributeLabel($attribute)
        ]);

        return array_map(function($message) use ($params) {
            return Yii::$app->getI18n()->format($message, $params, Yii::$app->language);
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
