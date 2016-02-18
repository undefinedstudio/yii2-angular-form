<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TestForm extends Model
{
    public $name;
    public $surname;
    public $age;
    public $email;
    public $compareEmail;
    public $phone;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'age'], 'required'],
            [['name', 'surname'], 'string', 'max' => 30],
            ['age', 'integer'],
            ['email', 'email'],
            ['repeatEmail', 'compare', 'compareAttribute' => 'email'],

            ['pattern', 'required'],
            ['pattern', 'match', 'pattern' => '/[a-z]{3}/', 'not' => true],

            ['phone', 'string',
                'min' => 10,
                'max' => 10,
                'tooShort' => 'Must be exactly {min} digits.',
                'tooLong' => 'Must be exactly {max} digits.'
            ],
            ['age', 'isAdult']
        ];
    }

    public function isAdult()
    {
        if ($this->age < 18) {
            $this->addError('age', 'You must be adult to continue.');
        }
    }

}
