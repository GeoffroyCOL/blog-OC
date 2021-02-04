<?php

namespace Framework\Form;

trait DataAttributeTrait
{
    protected string $dataAttr = "";

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
}
