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
        $html = '<div class="text-end mt-4"><button class="btn btn-primary text-uppercase" type="submit">'. $this->label .'</button></div>';

        return $html;
    }
}
