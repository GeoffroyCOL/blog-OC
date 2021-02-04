<?php

namespace Application\Service;

use Framework\Email\Email;
use Framework\HTTP\Request;

class ContactService
{
    private Request $request;
    private Email $email;

    const FIELDS = [
        'name', 'surname', 'email', 'message'
    ];

    public function __construct()
    {
        $this->request = new Request;
        $this->email = new Email;
    }

    public function sendEmailContact()
    {
        $fields = [];

        foreach(self::FIELDS as $field) {
            if ($this->request->postExists($field) && empty($this->request->postData($field))) {
                throw new \Exception("Le champs {$field} est vide", 400);
            }

            $fields[$field] = $this->request->postData($field);
        }

        $this->email->sendEmailContact($fields);
    }
}