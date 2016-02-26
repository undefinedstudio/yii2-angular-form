<?php

namespace undefinedstudio\yii2\angularform;

use undefinedstudio\yii2\angularform\validators\AngularValidator;

use yii\base\Model;
use yii\base\InvalidParamException;
use yii\validators\Validator;

class Html extends \yii\helpers\BaseHtml
{
    /**
     * @inheritdoc
     */
    public static function activeInput($type, $model, $attribute, $options = [])
    {
        if (!isset($options['ng-model'])) {
            $options['ng-model'] = static::getInputNgModel($model, $attribute);
        }

        // Set additional parameters required by angular validators
        $validators = $model->getActiveValidators($attribute);
        static::addAngularValidators($options, $validators);

        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }

        $name = Html::getInputName($model, $attribute);
        return static::input($type, $name, null, $options);
    }

    /**
     * @inheritdoc
     */
    public static function activeHiddenInput($model, $attribute, $options = [])
    {
        if (!isset($options['ng-value'])) {
            $options['ng-value'] = static::getInputNgModel($model, $attribute) . ' | json';
        }

        // Set additional parameters required by angular validators
        $validators = $model->getActiveValidators($attribute);
        static::addAngularValidators($options, $validators);

        return static::activeInput('hidden', $model, $attribute, $options);
    }

    /**
     * @inheritdoc
     */
    public static function activeTextarea($model, $attribute, $options = [])
    {
        if (!isset($options['ng-model'])) {
            $options['ng-model'] = static::getInputNgModel($model, $attribute);
        }

        // Set additional parameters required by angular validators
        $validators = $model->getActiveValidators($attribute);
        static::addAngularValidators($options, $validators);

        $name = Html::getInputName($model, $attribute);
        return static::textarea($name, null, $options);
    }

    /**
     * @inheritdoc
     */
    protected static function activeListInput($type, $model, $attribute, $items, $options = [])
    {
        if (!isset($options['ng-model'])) {
            $options['ng-model'] = static::getInputNgModel($model, $attribute);
        }

        // Set additional parameters required by angular validators
        $validators = $model->getActiveValidators($attribute);
        static::addAngularValidators($options, $validators);

        $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
        $selection = static::getAttributeValue($model, $attribute);
        if (!array_key_exists('unselect', $options)) {
            $options['unselect'] = '';
        }
        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }
        return static::$type($name, $selection, $items, $options);
    }

    /**
     * @inheritdoc
     */
    public static function activeCheckbox($model, $attribute, $options = [])
    {
        if (!isset($options['ng-model'])) {
            $options['ng-model'] = static::getInputNgModel($model, $attribute);
        }

        // Set additional parameters required by angular validators
        $validators = $model->getActiveValidators($attribute);
        static::addAngularValidators($options, $validators);

        $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);

        if (!array_key_exists('label', $options)) {
            $options['label'] = static::encode($model->getAttributeLabel(static::getAttributeName($attribute)));
        }

        $checked = false;

        if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }

        return static::checkbox($name, $checked, $options);
    }

    /**
     * @inheritdoc
     */
    public static function activeLabel($model, $attribute, $options = [])
    {
        $for = array_key_exists('for', $options) ? $options['for'] : null/*static::getInputId($model, $attribute)*/;
        $attribute = static::getAttributeName($attribute);
        $label = isset($options['label']) ? $options['label'] : static::encode($model->getAttributeLabel($attribute));
        unset($options['label'], $options['for']);
        return static::label($label, $for, $options);
    }

    /**
     * @inheritdoc
     */
    public static function error($model, $attribute, $options = [])
    {
        $attribute = static::getAttributeName($attribute);

        $tag = isset($options['tag']) ? $options['tag'] : 'div';
        unset($options['tag'], $options['formName']);

        // TODO: manage encode
        /*$encode = !isset($options['encode']) || $options['encode'] !== false;
        unset($options['encode']);*/

        $validators = $model->getActiveValidators($attribute);

        // Get all ng-message directives from the model
        $ngMessages = [];
        foreach(AngularValidator::getAngularValidators($validators) as $validator) {
            $ngMessages[] = static::ngMessages($validator, $model, $attribute);
        }
        $ngMessages[] = Html::tag('div', null, ['us-server-message' => true]);

        // Wrap up all ngMessages in a ng-messages directive
        $formName = $model->formName();
        $formNgModel = Html::getFormNgModel($model, $attribute);

        // Compute error showing condition
        $errorCondition = [];
        if (!isset($options['ifDirty']) || $options['ifDirty']) {
            $errorCondition[] = $formNgModel . '.$dirty';
            unset($options['ifDirty']);
        }
        if (!isset($options['ifTouched']) || $options['ifTouched']) {
            $errorCondition[] = $formNgModel . '.$touched';
            unset($options['ifTouched']);
        }
        $errorCondition = implode(' && ', $errorCondition);

        $ngMessages = Html::tag('div', implode("\n", $ngMessages), [
            'ng-messages' => $formNgModel . '.$error',
            'ng-if' => '(' . $errorCondition . ')  || ' . $formName . '.$submitted'
        ]);

        return Html::tag($tag, $ngMessages, $options);
    }

    /**
     * @param AngularValidator $validator The angular validator to get the validators from
     * @param Model $model The model instance
     * @param string $attribute The name of the attribute to get the ngMessages from
     * @return string The ngMessages HTML
     */
    public static function ngMessages($validator, $model, $attribute)
    {
        $validators = $validator->validators();

        $messages = $validator->prepareMessages($model, $attribute);

        $ngMessages = [];
        foreach($messages as $name => $message) {
            $ngMessages[] = Html::tag('div', $message, [
                'ng-message' => isset($validators[$name]) ? $validators[$name] : $validator->directive
            ]);
        }

        return implode("\n", $ngMessages);
    }

    /**
     * Generates an appropriate ngModel name for the specified attribute name or expression.
     *
     * This method generates a name that can be used as the input ngModel name to collect user input
     * for the specified attribute. The name is generated according to the [[Model::formName|form name]]
     * of the model and the given attribute name. For example, if the form name of the `Post` model
     * is `Post`, then the input name generated for the `content` attribute would be `Post[content]`.
     *
     * @param Model $model
     * @param string $attribute
     * @return string
     * @throws InvalidParamException
     */
    public static function getInputNgModel($model, $attribute)
    {
        $formName = $model->formName();

        // TODO: ngModel validation
        /*if (!preg_match('/(^|.*\])([\w\.]+)(\[.*|$)/', $attribute, $matches)) {
            throw new InvalidParamException('Attribute name must contain word characters only.');
        }*/

        return $formName == '' ? $attribute : $formName . '.$data.' . $attribute;
    }

    /**
     * {@inheritdoc}
     */
    public static function getInputName($model, $attribute)
    {
        return $attribute;
    }

    /**
     * {@inheritdoc}
     */
    public static function getInputId($model, $attribute)
    {
        // TODO: infer dynamic id from brackets ex: container[i].content => container-{{i}}-content
        return null;
    }

    /**
     * Generates the hierarchy to access the ngModel under the $form object in the AngularJS scope.
     * @param Model $model
     * @param string $attribute
     * @return string
     */
    public static function getFormNgModel($model, $attribute)
    {
        $formName = $model->formName();
        return $formName == '' ? $attribute : "$formName.$attribute";
    }

    /**
     * Adds angular validator directives to the specified otpions array.
     * @param array $options the options to be modified.
     * @param Validator[] $validators validators that must be added as directives to the field tag.
     */
    public static function addAngularValidators(&$options, $validators)
    {
        // Retrieve the angular validators only
        $validators = AngularValidator::getAngularValidators($validators);

        foreach($validators as $validator) {
            if (!empty($validator->directive)) {
                $options[$validator->directive] = true;
            }

            $options = array_merge($validator->params(), $options);
        }
    }
}
