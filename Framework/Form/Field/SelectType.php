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
        $name = ! isset($this->data['translate']) ? $label : $this->data['translate'];

        $html = '<div class="mb-3"><label class="fw-bold" for='. $label .'>'. ucfirst($name) .'</label>
            <select class="form-select" name="'. $label .'" id="'. $label .'">';
            foreach($this->repository->findAll() as $entity) {
                $html .= '<option '. $this->selected($value, $entity->getId()) .' value="'. $entity->getId() .'">'. $entity->getName() .'</option>';
            }
        $html .= '</select></div>';

        return $html;
    }
    
    /**
     * selected
     *
     * @param  string $value
     * @param  string $option
     * @return string|null
     */
    private function selected($value, $option)
    {
        if ($value && preg_match('#'. $value .'#', $option)) {
            return 'selected';
        }
    }
}
