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
        $sql = 'SELECT id, pseudo, email, password, role, connectedAt, avatar, createdAt FROM user WHERE id = :id';

        $request = $this->bdd->prepare($sql);

        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if ($data['role'] === 'reader') {
            $data['isValide'] = $this->isValideUser($data['id']);
        }

        return $this->entity->generateEntity($data, ucfirst($data['role']));
    }

    public function isValideUser(int $ident) {
        $sql = 'SELECT userId, isValide FROM reader WHERE userId = :id';
        $request = $this->bdd->prepare($sql);
        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        return $data['isValide'];
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

        $this->persistReader($this->bdd->lastInsertId(), $user->getIsValide());
    }
    
    /**
     * persistReader
     *
     * @param  int $id
     * @return void
     */
    private function persistReader(int $ident, bool $isValide): void
    {
        $request = $this->bdd->prepare('INSERT INTO reader(userId, isValide) VALUES(:userId, :isValide)');
        $request->bindValue(':userId', $ident, \PDO::PARAM_INT);
        $request->bindValue(':isValide', $isValide, \PDO::PARAM_BOOL);

        $request->execute();
    }
    
    /**
     * isUniqueEntity
     *
     * @param  string $pseudo
     * @return bool
     */
    public function isUniqueEntity(string $pseudo)
    {
        $request = $this->bdd->prepare('SELECT id, pseudo, role FROM user WHERE pseudo = :pseudo');

        $request->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $request->execute();

        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    public function edit(User $user)
    {
        $request = $this->bdd->prepare('UPDATE user SET email = :email, password = :password, avatar = :avatar WHERE id = :id');

        $request->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $request->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $request->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);

        $avatar = $user->getAvatar() ? $user->getAvatar()->getId() : null;
        $request->bindValue(':avatar', $avatar, \PDO::PARAM_STR | \PDO::PARAM_NULL);

        $request->execute();
    }
}