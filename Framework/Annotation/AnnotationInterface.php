<?php

namespace Framework\Annotation;

interface AnnotationInterface
{    
    /**
     * setAnnotationsInfile
     *
     * @return void
     */
    public function setAnnotationsInfile();
    
    /**
     * getListAnnotation
     *
     * @return array
     */
    public function getListAnnotation(): array;
}