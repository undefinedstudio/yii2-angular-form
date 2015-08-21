<?php

namespace undefinedstudio\yii2\angularwidgets;

use undefinedstudio\yii2\angularform\Html;
use yii\helpers\ArrayHelper;

class MdChips extends AngularWidget
{
    public $modelAttribute = 'md-search-text';
    public $options = [];
    public $itemTemplate = '';

    public $selectedItem = 'selectedItem';
    public $searchTextChange;
    public $searchText = 'searchText';
    public $selectedItemChange;
    public $items;
    public $itemText;
    public $minLength = 3;
    public $delay = 200;
    public $placeholder = '';

    public function run()
    {
        $this->options = ArrayHelper::merge([
            'md-selected-item' => $this->selectedItem,
            'md-search-text-change' => $this->replaceSearchText($this->searchTextChange),
            'md-search-text' => $this->searchText,
            'md-selected-item-change' => $this->replaceSearchText($this->selectedItemChange),
            'md-items' => $this->replaceSearchText($this->items),
            'md-item-text' => $this->itemText,
            'md-min-length' => $this->minLength,
            'md-delay' => $this->delay,
            'placeholder' => $this->placeholder
        ], $this->options);
        return Html::tag('md-autocomplete', Html::tag('md-item-template', $this->itemTemplate), $this->options);
    }

    public function replaceSearchText($value, $placeholder = '{searchText}')
    {
        return str_replace(
            $placeholder,
            $this->options[$this->modelAttribute],
            $value
        );
    }
}
