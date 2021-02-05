<?php

namespace Framework\Annotation;

class AnnotationFactory
{
    /**
     * getClassAnnotation
     *
     * @param  string $nameClassAnnotation
     */
    public static function getClassAnnotation(string $nameClassAnnotation, string $component)
    {
        if (class_exists('Framework\\Annotation\\'.$nameClassAnnotation)) {
            $class = 'Framework\\Annotation\\' . $nameClassAnnotation;
            return new $class($component);
        }

        throw new \Exception("La class {$nameClassAnnotation} n'existe pas", 404);
    }
}
