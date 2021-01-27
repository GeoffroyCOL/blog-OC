<?php

namespace Framework\Form\Field;

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

    public function get(): string
    {

        $label = ! isset($this->data['label']) ? '' : $this->data['label'];
        $value = ! isset($this->data['value']) ? '' : $this->data['value'];

        $html = '<div>
            <label for="'. $label .'">' . ucfirst($label) . '</label>
            <input value="'. $value .'" ' . $this->getDataAttr() . ' type="' . $this->type . '" name="'. $label .'" id="'. $label .'">
        </div>';

        if (isset($this->data['help'])) {
            $html .= '<span>'. $this->data['help'] .'</span>';
        }

        return $html;
    }
}