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
        $html = '<div class="mt-6"><button class="btn btn-link" type="submit">'. $this->label .'</button></div>';

        return $html;
    }
}
