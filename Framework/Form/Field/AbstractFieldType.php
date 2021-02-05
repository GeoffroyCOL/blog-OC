<?php

/**
 * Génère le champs du formulaire selon son type
 */

namespace Framework\Form\Field;

use Framework\HTTP\Request;
use Framework\Form\FormErrors;
use Framework\Form\DataAttributeTrait;

class AbstractFieldType
{
    use DataAttributeTrait;

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->setDataAttr();
    }
    
    /**
     * getData
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
    
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
            <label class="form-label fw-bold mb-0" for="'. $label .'">' . ucfirst($name) . '</label>
            <input class="form-control" value="'. $value .'" ' . $this->getDataAttr() . ' type="' . $this->type . '" name="'. $label .'" id="'. $label .'">';

        if (isset($this->data['help'])) {
            $html .= '<small class="text-secondary">'. $this->data['help'] .'</small>';
        }

        $html .= '</div>';

        return $html;
    }
}
