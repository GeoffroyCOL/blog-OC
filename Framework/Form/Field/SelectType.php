<?php

namespace Framework\Form\Field;

use Framework\Form\Field\AbstractFieldType;

class SelectType extends AbstractFieldType
{
    private $repository;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $repository = "Application\\Repository\\" . ucfirst($data['class']) . "Repository";
        $this->repository = new $repository;
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

        $html = '<div><label for='. $label .'>'. $label .'</label>
            <select name="'. $label .'" id="'. $label .'">';
            foreach($this->repository->findAll() as $entity) {
                $html .= '<option value="'. $entity->getId() .'">'. $entity->getName() .'</option>';
            }
        $html .= '</select></div>';

        return $html;
    }
}