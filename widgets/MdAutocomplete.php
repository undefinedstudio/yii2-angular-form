<?php

namespace undefinedstudio\yii2\angularwidgets;

use undefinedstudio\yii2\angularform\Html;
use yii\helpers\ArrayHelper;

class MdAutocomplete extends AngularWidget
{
    public $modelAttribute = 'md-search-text';
    public $options = [];
    public $itemTemplate = '';
    public $notFound = 'No matches found.';

    public $selectedItem;
    public $searchTextChange;
    public $searchText = 'searchText';
    public $selectedItemChange;
    public $items;
    public $itemText;
    public $minLength = 2;
    public $delay = 200;
    public $placeholder = '';
    public $menuClass;

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
            'placeholder' => $this->placeholder,
            'md-menu-class' => $this->menuClass
        ], $this->options);

        $hiddenInput = Html::activeHiddenInput($this->model, $this->attribute);

        $itemTemplate = Html::tag('md-item-template', $this->itemTemplate);
        $notFound = Html::tag('md-not-found', $this->notFound);
        return $hiddenInput . Html::tag('md-autocomplete', $itemTemplate . $notFound, $this->options);
    }

    public function replaceSearchText($value, $placeholder = '{searchText}')
    {
        $replacement = $this->options[$this->modelAttribute];
        return str_replace($placeholder, $replacement, $value) ?: null;
    }
}
