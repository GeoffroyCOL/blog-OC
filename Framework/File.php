<?php

/**
 * Cette class permet de lister la liste des fichiers contenu dans un dossier
 */

namespace Framework;

class file extends \SplFileInfo
{
    private array $listFiles = [];
    
    /**
     * getListFile
     * 
     * Récupère la liste des fichiers contenue dans un dossier avec le namespace.
     *
     * @param  string|null $dir
     * @return array
     */
    public function getListFile(?string $dir = ""): array
    {
        $folder = __ROOT__ . DIRECTORY_SEPARATOR . $this->getPathName() . $dir;
        $iterator = new \DirectoryIterator($folder);
        
        foreach ($iterator as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                $this->getListFile($dir . DIRECTORY_SEPARATOR . $file->getFilename());
            }
            
            if ($file->isfile()) {
                $this->listFiles[] = str_replace('/', '\\' , $this->getPathName() . $dir . DIRECTORY_SEPARATOR . str_replace('.php', '', $file->getFileName()));
            }
        }
        
        return $this->listFiles;
    }
}