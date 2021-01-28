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

        $html = '<div>
            <textarea name="'. $label .'" id="'. $label .'"></textarea>
        </div>';

        return $html;
    }
}
