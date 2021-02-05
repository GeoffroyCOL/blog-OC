<?php

namespace Framework\Form\Field;

use Framework\Form\DataAttributeTrait;
use Framework\Form\Field\AbstractFieldType;

class TextareaType extends AbstractFieldType
{
    use DataAttributeTrait;

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
            <label class="form-label fw-bold mb-0" form="'. $label .'">'. ucfirst($name) .'</label>
            <textarea '. $this->getDataAttr() .' class="form-control" name="'. $label .'" id="'. $label .'">'. $value .'</textarea>
        </div>';

        return $html;
    }
}
