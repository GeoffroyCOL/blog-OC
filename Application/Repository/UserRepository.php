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
}