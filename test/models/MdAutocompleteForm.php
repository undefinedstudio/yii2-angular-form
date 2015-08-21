<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class MdAutocompleteForm extends Model
{
    public $fruit;
    public $vegetable;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fruit', 'vegetable'], 'required'],
            [['fruit', 'vegetable'], 'string']
        ];
    }
}
