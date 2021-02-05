<?php

/**
 * permet d'envoyer des emails
 */

namespace Framework\Email;

use Application\Entity\User;
use Application\Entity\Comment;

class Email
{
    const EMAILADMIN = 'geoffroy.colpart81@gmail.com';
    
    /**
     * sendInscription
     *
     * Email envoyé à l'administrateur pour une demande d'inscription
     *
     * @param  User $user
     * @return void
     */
    public function sendInscription(User $user): void
    {
        $subject = "Demande d'inscription";

        $message = '<html><body>';
        $message .= '<p>Bonjour vous avez recu une demande d\'inscription.</p>';
        $message .= '<p>Pseudo : ' . $user->getPseudo() . '</p>';
        $message .= '<p>Adresse email : ' . $user->getEmail() . '</p>';
        $message .= '</html></body>';

        $this->sendEmail(self::EMAILADMIN, $subject, $message);
    }

    /**
     * sendValide
     *
     * Email envoyer à un utilisateur pour la validité de sa demande d'inscription
     *
     * @param  User $user
     * @return void
     */
    public function sendValide(User $user): void
    {
        $subject = "Validation d'inscription";

        $message = '<html><body>';
        $message .= '<p>Bonjour et bienvenue '. $user->getPseudo() .', votre demande d\'inscription à bien été validé.</p>';
        $message .= '</html></body>';

        $this->sendEmail($user->getEmail(), $subject, $message);
    }

    /**
     * sendValide
     *
     * Email envoyer à un utilisateur pour lui signaler que sa demande a été refussée
     *
     * @param  User $user
     * @return void
     */
    public function sendNotValide(User $user): void
    {
        $subject = "Validation d'inscription";

        $message = '<html><body>';
        $message .= '<p>Bonjour '. $user->getPseudo() .', votre demande d\'inscription n\'à pas été validé.</p>';
        $message .= '</html></body>';

        $this->sendEmail($user->getEmail(), $subject, $message);
    }
        
    /**
     * sendValideComment
     * 
     * Pour la validation d'un commentaire
     *
     * @param  Comment $comment
     * @return void
     */
    public function sendValideComment(Comment $comment): void
    {
        $subject = "Validation de votre commentaire";

        $message = '<html><body>';
        $message .= '<p>Bonjour '. $comment->getAutor()->getPseudo() .', votre commentaire posté sur l\'article '. $comment->getPost()->getTitle() .' le '. $comment->getCreatedAt()->format('d md Y') .' a bien ';
        $message .= ' été validé</p>';
        $message .= '</html></body>';

        $this->sendEmail($comment->getAutor()->getEmail(), $subject, $message);
    }
    
    /**
     * sendEmailContact - Pour le formulaire de contact
     *
     * @param  array $data
     * @return void
     */
    public function sendEmailContact(array $data): void
    {
        $subject = "Message de {$data['name']} {$data['surname']}";

        $message = '<html><body>' . $data['message'] . '</html></body>';

        $this->sendEmail($data['email'], $subject, $message);
    }
    
    /**
     * sendEmail - Permet l'envoie des emails
     *
     * @param  string $sendTo
     * @param  string $subject
     * @param  string $message
     * @return void
     */
    private function sendEmail($sendTo, $subject, $message): void
    {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: webmaster@example.com' . "\r\n";
        $headers .= 'Content-type: Text/html; charset=utf-8' . "\r\n";

        mail($sendTo, $subject, $message, $headers);
    }
}
