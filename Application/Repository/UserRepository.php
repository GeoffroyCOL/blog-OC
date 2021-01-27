<?php

namespace Application\Repository;

use Application\Entity\User;
use Framework\Manager\AbstractManager;
use Framework\Error\NotFoundEntityException;

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
        $sql = 'SELECT id, pseudo, email, password, role, connectedAt, avatar, createdAt 
            FROM user WHERE id = :id';

        $request = $this->bdd->prepare($sql);

        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if (! $data) {
            throw new NotFoundEntityException("L'utilisateur n'existe pas", 400);
        }

        if ($data['role'] === 'reader') {
            $data['isValide'] = $this->isValideUser($data['id']);
        }

        return $this->entity->generateEntity($data, ucfirst($data['role']));
        
    }
    
    /**
     * findAll
     *
     * @return array
     */
    public function findAll(): array
    {
        $listUsers = [];

        $sql =
            'SELECT user.id, user.pseudo, user.email, user.password, user.role, user.connectedAt, user.avatar, user.createdAt, reader.userId, reader.isValide
                FROM user
                INNER JOIN reader on reader.userId = user.id
                where user.role = "reader"';

        $request = $this->bdd->prepare($sql);
        $request->execute();

        $datas = $request->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $data) {
            $listUsers[] = $this->entity->generateEntity($data, 'Reader');
        }

        return $listUsers;
    }
    
    /**
     * isValideUser
     *
     * @param  int $ident
     * @return bool
     */
    public function isValideUser(int $ident): bool
    {
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

    public function delete(User $user)
    {
        $request = $this->bdd->prepare('DELETE FROM user WHERE id = :id LIMIT 1');
        $request->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        
        $request->execute();
    }

    public function valide(int $ident)
    {
        $request = $this->bdd->prepare('UPDATE reader SET isValide = :isValide WHERE userId = :id');
        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->bindValue(':isValide', true, \PDO::PARAM_BOOL);

        $request->execute();
    }
}
