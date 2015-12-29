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
