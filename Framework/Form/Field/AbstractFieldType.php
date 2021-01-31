<?php

namespace Framework\Form\Field;

use Framework\HTTP\Request;
use Framework\Form\FormErrors;

class AbstractFieldType
{
    protected array $data;
    protected string $dataAttr = "";

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
     * setDataAttr
     *
     * @return void
     */
    private function setDataAttr()
    {
        if (array_key_exists('attr', $this->data)) {
            foreach ($this->data['attr'] as $key => $attr) {
                $this->dataAttr .= $key .'='. $attr . ' ';
            }
        }
    }
    
    /**
     * getDataAttr
     *
     * @return string
     */
    private function getDataAttr(): string
    {
        return $this->dataAttr;
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
            <label class="font-bold uppercase" for="'. $label .'">' . ucfirst($name) . '</label>
            <input value="'. $value .'" ' . $this->getDataAttr() . ' type="' . $this->type . '" name="'. $label .'" id="'. $label .'">';
        $html .= '</div>';

        if (isset($this->data['help'])) {
            $html .= '<span>'. $this->data['help'] .'</span>';
        }

        return $html;
    }
}