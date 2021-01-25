<?php

namespace Application\Repository;

use Application\Entity\User;
use Framework\Manager\AbstractManager;

class UserRepository extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * find
     *
     * @param  int $ident
     * @return User
     */
    public function find(int $ident): User
    {
        $request = $this->bdd->prepare(
            'SELECT id, pseudo, email, password, role, connectedAt, avatar, createdAt
                FROM user
                WHERE id = :id'
        );

        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        return $this->entity->generateEntity($data, ucfirst($data['role']));
    }
    
    /**
     * persist
     *
     * @param  User $user
     * @return void
     */
    public function persist(User $user): void
    {
        $request = $this->bdd->prepare('INSERT INTO user(pseudo, email, password, createdAt, role, avatar) VALUES(:pseudo, :email, :password, :createdAt, :role, :avatar) ');

        $request->bindValue(':pseudo', $user->getPseudo(), \PDO::PARAM_STR);
        $request->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $request->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $request->bindValue(':createdAt', $user->getCreatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $request->bindValue(':role', $user->getRole(), \PDO::PARAM_STR);

        $avatar = $user->getAvatar() ? $user->getAvatar()->getId() : null;
        $request->bindValue(':avatar', $avatar, \PDO::PARAM_STR | \PDO::PARAM_NULL);

        $request->execute();

        $this->persistReader($this->bdd->lastInsertId(), false);
    }
    
    /**
     * persistReader
     *
     * @param  int $id
     * @return void
     */
    private function persistReader(int $id): void
    {
        $request = $this->bdd->prepare('INSERT INTO reader(userId, isValide) VALUES(:userId, false)');
        $request->bindValue(':userId', $id, \PDO::PARAM_INT);

        $request->execute();
    }
}