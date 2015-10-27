<?php

namespace undefinedstudio\yii2\angularform;

use undefinedstudio\yii2\angularform\validators\AngularBuiltInValidator;
use undefinedstudio\yii2\angularform\validators\AngularValidator;
use undefinedstudio\yii2\angularform\validators\AngularValidatorInterface;
use yii\helpers\BaseHtml;

use yii\base\Model;
use yii\base\InvalidParamException;

use undefinedstudio\yii2\angularform\validators\RequiredValidator;
use undefinedstudio\yii2\angularform\validators\StringValidator;

class Html extends BaseHtml
{
    /**
     * @inheritdoc
     */
    public static function activeInput($type, $model, $attribute, $options = [])
    {
        if (!isset($options['ng-model'])) {
            $options['ng-model'] = static::getInputNgModel($model, $attribute);
        }

        // Set additional parameters required by validators
        foreach(AngularValidator::getAngularValidators($model, $attribute) as $validator) {
            if (!empty($validator->directive)) {
                $options[$validator->directive] = true;
            }

            $options = array_merge($validator->params(), $options);
        }

        // TODO: infer dynamic id from brackets ex: container[i].content => container-{{i}}-content
        /*if (!array_key_exists('id', $options)) {
            $options['id'] = static::getInputId($model, $attribute);
        }*/

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
        return static::activeInput('hidden', $model, $attribute, $options);
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
        if (!isset($options['formName'])) {
            throw new \InvalidArgumentException("AngularForm requires you to provide a form name.");
        }

        $attribute = static::getAttributeName($attribute);

        $formName = $options['formName'];
        $tag = isset($options['tag']) ? $options['tag'] : 'div';
        unset($options['tag'], $options['formName']);

        /*$encode = !isset($options['encode']) || $options['encode'] !== false;
        unset($options['encode']);*/

        $content = array_map(function(AngularValidator $validator) use ($model, $attribute, $formName) {
            return $validator->renderValidator($model, $attribute, $formName);
        }, AngularValidator::getAngularValidators($model, $attribute));

        return Html::tag($tag, implode("\n", $content), $options);
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

        return $formName == '' ? $attribute : "$formName.$attribute";
    }

    /**
     * Generates the hierarchy to access the ngModel under the $form object in the AngularJS scope.
     * @param Model $model
     * @param string $attribute
     * @param string $formName
     * @return string
     */
    public static function getFormNgModel($model, $attribute, $formName)
    {
        return $formName . "['" . Html::getInputName($model, $attribute) . "']";
    }
}
