<?php

namespace Framework\Form\Field;

use Framework\Form\Field\AbstractFieldType;

class TextareaType extends AbstractFieldType
{
    /**
     * get
     *
     * @return string
     */
    public function get(): string
    {
        $label = ! isset($this->data['label']) ? '' : $this->data['label'];
        $value = ! isset($this->data['value']) ? '' : $this->data['value'];
        $name = ! isset($this->data['translate']) ? $label : $this->data['translate'];

        $html = '<div class="mb-3">
            <label class="font-bold uppercase" form="'. $label .'">'. ucfirst($name) .'</label>
            <textarea name="'. $label .'" id="'. $label .'">'. $value .'</textarea>
        </div>';

        return $html;
    }
}
