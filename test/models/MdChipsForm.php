<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class MdChipsForm extends Model
{
    public $words;
    public $vegetables;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['words', 'vegetables'], 'undefinedstudio\yii2\angularform\validators\ArrayValidator', 'min' => 2]
        ];
    }
}
