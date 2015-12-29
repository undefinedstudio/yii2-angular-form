<?php

namespace undefinedstudio\yii2\angularform\validators;

use Yii;
use yii\base\Model;
use yii\validators\Validator;

class AngularValidator extends Validator
{
    /** @var string The directive that holds the validator */
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
     * Defines the parameter values for directives
     * e.g ['max' => 10] sets the attribute max="10" on the input tag
     * @return array
     */
    public function params()
    {
        return [];
    }

    /**
     * Defines the parameter values for messages
     * e.g. ['max' => 10] translates the parameter {max} in messages to 10
     * @return array
     */
    public function messageParams()
    {
        return $this->params();
    }

    /**
     * Applies the required formatting and params to messages.
     * @param Model $model
     * @param string $attribute
     * @return array Prepared messages
     */
    public function prepareMessages($model, $attribute)
    {
        $params = array_merge($this->messageParams(), [
            'attribute' => $model->getAttributeLabel($attribute)
        ]);

        $messages = [];
        foreach($this->messages() as $name => $message) {
            $messages[$name] = Yii::$app->getI18n()->format($message, $params, Yii::$app->language);
        }

        return $messages;
    }

    /**
     * Return the given validators, with converted validators when possible
     * @param Validator[] $validators
     * @return Validator[]
     */
    public static function convertBuiltInValidators($validators)
    {
        foreach($validators as $i => $validator) {
            // Try to get wrapper if built-in validator
            if (!($validator instanceof AngularValidator)) {
                $convertedValidator = AngularBuiltInValidator::createFromBuiltIn($validator);
                $validators[$i] = $convertedValidator ?: $validator;
            }
        }
        return $validators;
    }

    /**
     * Filters out non AngularValidators from the given validators
     * @param Validator[] $validators
     * @return AngularValidator[]
     */
    public static function getAngularValidators($validators)
    {
        foreach($validators as $i => $validator) {
            // Try to get wrapper if built-in validator
            if (!($validator instanceof AngularValidator)) {
                $validators[$i] = AngularBuiltInValidator::createFromBuiltIn($validator);

                // If validator is not supported by angular, skip
                if ($validators[$i] == null) {
                    unset($validators[$i]);
                }
            }
        }

        // Add ServerValidator to render server messages
        // TODO: don't require this
        $validators[] = new ServerValidator();

        return $validators;
    }
}
