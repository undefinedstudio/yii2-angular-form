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

    /**
     * @inheritdoc
     */
    public function renderValidator($model, $attribute)
    {
        $messages = [];
        foreach($this->prepareMessages($model, $attribute) as $name => $message) {
            $messages[] = Html::tag('message', $message, compact('name'));
        }

        return Html::tag('validator', implode("\n", $messages), [
            'ng-model' => Html::getInputNgModel($model, $attribute),
            $this->directive => true
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
}
