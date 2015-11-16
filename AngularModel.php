<?php

namespace undefinedstudio\yii2\angularform;

use yii\base\Model;
use undefinedstudio\yii2\angularform\validators\AngularValidator;

/**
 *  {@inheritdoc}
 */
class AngularModel extends Model
{
    /** {@inheritdoc} */
    protected $_errors;

    /**
     * {@inheritdoc}
     * @return AngularValidator[] validators
     */
    public function createValidators()
    {
        $validators = parent::createValidators()->getArrayCopy();
        return AngularValidator::convertBuiltInValidators($validators);
    }

    //region Errors
    /**
     * {@inheritdoc}
     */
    public function hasErrors($attribute = null)
    {
        return $attribute === null ? !empty($this->_errors) : isset($this->_errors[$attribute]);
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors($attribute = null)
    {
        if ($attribute === null) {
            return $this->_errors === null ? [] : $this->_errors;
        } else {
            return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : [];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstErrors()
    {
        if (empty($this->_errors)) {
            return [];
        } else {
            $errors = [];
            foreach ($this->_errors as $name => $es) {
                if (!empty($es)) {
                    $error = reset($es);
                    $errors[$name] = [key($es) => $error];
                }
            }
            return $errors;
        }
    }

    /**
     * {@inheritdoc}
     * @param string|null $key
     */
    public function addError($attribute, $error = '', $key = null)
    {
        parent::addError($attribute, $error);
        if ($key === null) {
            $this->_errors[$attribute][] = $error;
        } else {
            $this->_errors[$attribute][$key] = $error;
        }
    }

    /**
     * {@inheritdoc}
     * @param string|null $key
     */
    public function addErrors(array $items)
    {
        foreach ($items as $attribute => $errors) {
            if (is_array($errors)) {
                if (is_array($errors)) {
                    foreach ($errors as $es) {
                        foreach($es as $key => $error) {
                            $this->addError($attribute, $error, $key);
                        }
                    }
                } else {
                    foreach ($errors as $error) {
                        $this->addError($attribute, $error);
                    }
                }

            } else {
                $this->addError($attribute, $errors);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearErrors($attribute = null, $key = null)
    {
        parent::clearErrors($attribute);
        if ($attribute === null) {
            $this->_errors = [];
        } else {
            if ($key === null) {
                unset($this->_errors[$attribute]);
            } else {
                unset($this->_errors[$attribute][$key]);
            }
        }
    }
    //endregion
}