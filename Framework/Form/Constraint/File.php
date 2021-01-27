<?php


namespace Framework\Form\Constraint;

class File
{
    private ?array $data;

    public function __construct(?array $data = [])
    {
        $this->data = $data;
    }
    
    /**
     * verify
     *
     * @param  string $data
     * @return string|bool
     */
    public function verify()
    {
        $errors = [];

        $file = $_FILES[$this->data['name']];

        if ($file['error'] !== UPLOAD_ERR_OK && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            return "Problème lors du télécharement du fichier";
        }

        if ($file['type'] !== '' && ! preg_match('#'. $this->data['type'] .'#', $file['type'])) {
            $ext = str_replace('image/', '', $file['type']);
            $errors['type'] = "L'extension {$ext} n'est pas demandée.";
        }

        if (array_key_exists('size', $this->data)) {
            if ($file['size'] >= $this->data['size']) {
                $errors['size'] = "Le taille du fichie est volumineux.";
            }
        }

        return ! empty($errors) ? $errors : false;
    }
}
