<?php

namespace undefinedstudio\yii2\angularform;

use Yii;
use yii\base\Widget;
use yii\base\Model;
use yii\base\InvalidCallException;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AngularForm extends Widget
{
    /**
     * @var array the HTML attributes (name-value pairs) for the form tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'undefinedstudio\yii2\angularform\AngularField';

    /** @var string The form name */
    public $name;

    /** @var Model The model object */
    public $model;

    /** @var string The resource to post the form data to */
    public $action;

    /**
     * @var array|string $action the form action URL. This parameter will be processed by [[\yii\helpers\Url::to()]].
     * @see method for specifying the HTTP method for this form.
     */
    public $ngSubmit;

    /** @var bool Allow nested forms definition by using the ng-form tag */
    public $nested = false;

    /**
     * @var array|\Closure the default configuration used by [[field()]] when creating a new field object.
     * This can be either a configuration array or an anonymous function returning a configuration array.
     * If the latter, the signature should be as follows,
     *
     * ```php
     * function ($model, $attribute)
     * ```
     *
     * The value of this property will be merged recursively with the `$options` parameter passed to [[field()]].
     *
     * @see fieldClass
     */
    public $fieldConfig = [];

    /** @var AngularField[] the ActiveField objects that are currently active */
    private $_fields = [];

    /**
     * Initializes the widget.
     * This renders the form open tag.
     */
    public function init()
    {
        $this->name = !empty($this->name) ?  $this->name : $this->model->formName();

        $this->options = array_merge([
            'name' => $this->name,
            'action' => empty($this->action) ? null : $this->action,
            'novalidate' => true,
            'ng-submit' => empty($this->ngSubmit) ? null : $this->ngSubmit
        ], $this->options);

        echo Html::beginTag($this->nested ? 'ng-form' : 'form', $this->options);
    }

    /**
     * Runs the widget.
     * This registers the necessary javascript code and renders the form close tag.
     * @throws InvalidCallException if `beginField()` and `endField()` calls are not matching
     */
    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }

        echo Html::endTag($this->nested ? 'ng-form' : 'form');
    }

    /**
     * Generates a form field.
     * A form field is associated with a model and an attribute. It contains a label, an input and an error message
     * and use them to interact with end users to collect their inputs for the attribute.
     * @param string $attribute the attribute name or expression. See [[Html::getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the additional configurations for the field object. These are properties of [[AngularField]]
     * or a subclass, depending on the value of [[fieldClass]].
     * @return AngularField the created ActiveField object
     * @see fieldConfig
     */
    public function field($attribute, $options = [])
    {
        $config = $this->fieldConfig;
        if ($config instanceof \Closure) {
            $config = call_user_func($config, $this->model, $attribute);
        }

        if (!isset($config['class'])) {
            $config['class'] = $this->fieldClass;
        }

        return Yii::createObject(ArrayHelper::merge($config, $options, [
            'model' => $this->model,
            'attribute' => $attribute,
            'form' => $this,
        ]));
    }

    /**
     * Begins a form field.
     * This method will create a new form field and returns its opening tag.
     * You should call [[endField()]] afterwards.
     * @param string $attribute the attribute name or expression. See [[Html::getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the additional configurations for the field object
     * @return string the opening tag
     * @see endField()
     * @see field()
     */
    public function beginField($attribute, $options = [])
    {
        $field = $this->field($attribute, $options);
        $this->_fields[] = $field;
        return $field->begin();
    }

    /**
     * Ends a form field.
     * This method will return the closing tag of an active form field started by [[beginField()]].
     * @return string the closing tag of the form field
     * @throws InvalidCallException if this method is called without a prior [[beginField()]] call.
     */
    public function endField()
    {
        $field = array_pop($this->_fields);
        if ($field instanceof AngularField) {
            return $field->end();
        } else {
            throw new InvalidCallException('Mismatching endField() call.');
        }
    }
}