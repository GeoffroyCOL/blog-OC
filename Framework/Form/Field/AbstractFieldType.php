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

    private function setDataAttr()
    {
        if (array_key_exists('attr', $this->data)) {
            foreach ($this->data['attr'] as $key => $attr) {
                $this->dataAttr .= $key .'='. $attr . ' ';
            }
        }
    }

    private function getDataAttr()
    {
        return $this->dataAttr;
    }

    public function get(): string
    {
        $html = '<div>
            <label for="'. $this->data['label'] .'">' . ucfirst($this->data['label']) . '</label>
            <input ' . $this->getDataAttr() . ' type="' . $this->type . '" name="'. $this->data['label'] .'" id="'. $this->data['label'] .'">
        </div>';

        if (isset($this->data['help'])) {
            $html .= '<span>'. $this->data['help'] .'</span>';
        }

        return $html;
    }
}