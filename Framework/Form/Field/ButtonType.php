<?php

namespace Framework\Form\Field;

class ButtonType
{
    private string $label;

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    public function get(): string
    {
        $html = '<div><button type="submit">'. $this->label .'</button></div>';

        return $html;
    }
}
