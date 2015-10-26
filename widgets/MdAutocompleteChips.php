<?php

namespace undefinedstudio\yii2\angularwidgets;

use undefinedstudio\yii2\angularform\Html;
use yii\helpers\ArrayHelper;

class MdAutocompleteChips extends AngularWidget
{
    public $options = [];
    public $chipTemplate;

    public $autocompleteSnap = false;
    public $requireMatch = false;

    public $items;
    public $itemText;
    public $itemTemplate = '';
    public $searchText = 'searchText';
    public $placeholder = '';

    public $autocompleteConfig = [];

    public function run()
    {
        $this->options = ArrayHelper::merge([
            'md-autocomplete-snap' => !empty($this->autocompleteSnap) ? $this->autocompleteSnap : null,
            'md-require-match' => !empty($this->requireMatch) ? $this->requireMatch : null,
        ], $this->options);

        $chipTemplate = $this->chipTemplate ? Html::tag('md-chip-template', $this->chipTemplate) : '';

        $this->autocompleteConfig = ArrayHelper::merge([
            'items' => $this->items,
            'itemText' => $this->itemText,
            'itemTemplate' => $this->itemTemplate,

            'placeholder' => $this->placeholder
        ], $this->autocompleteConfig);

        if ($this->model && $this->attribute) {
            echo Html::activeHiddenInput($this->model, $this->attribute);
        }

        $content = MdAutocomplete::widget($this->autocompleteConfig);
        echo Html::tag('md-chips', $content . $chipTemplate, $this->options);
    }
}
