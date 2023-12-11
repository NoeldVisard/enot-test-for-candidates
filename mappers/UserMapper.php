<?php

declare(strict_types=1);

namespace app\mappers;

use app\core\Model;
use app\core\Mapper;
use app\models\User;

class UserMapper extends Mapper
{
    private \PDOStatement $update;
    private \PDOStatement $delete;
    private \PDOStatement $insert;
    private \PDOStatement $find;
    private \PDOStatement $findAll;

    private \PDOStatement $findByEmail;

    public function __construct()
    {
        parent:: __construct();
        $this->update = $this->getPdo()->prepare("UPDATE \"user\" SET email = :email, password = :password WHERE id = :id");
        $this->delete = $this->getPdo()->prepare("DELETE FROM \"user\" WHERE id = :id");
        $this->insert = $this->getPdo()->prepare("INSERT INTO \"user\" (email, password) VALUES (:email, :password)");
        $this->find = $this->getPdo()->prepare("SELECT * FROM \"user\" WHERE  id = :id");
        $this->findAll = $this->getPdo()->prepare("SELECT * FROM \"user\"");

        $this->findByEmail = $this->getPdo()->prepare("SELECT * FROM \"user\" WHERE email = :email");
    }

    protected function doInsert(Model $object): Model
    {
        $this->insert->execute(
            [
                'email' => $object->getEmail(),
                'password' => $object->getPassword(),
            ]
        );

        $rowId = $this->getPdo()->lastInsertId();
        $object->setId((int)$rowId);
        return $object;
    }

    protected function doUpdate(Model $object): Model
    {
        try {
            $this->update->execute(
                [
                    'id' => $object->getId(),
                    'email' => $object->getEmail(),
                    'password' => $object->getPassword()
                ]
            );
            $rowId = $this->getPdo()->lastInsertId();
            $object->setId((int)$rowId);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $object;
    }

    protected function doDelete(Model $object): void
    {
        try {
            $this->delete->execute(
                [
                    'id' => $object->getId()
                ]
            );
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function doCreate(array $object): Model
    {
        return new User($object['email'], $object['password'], $object['id']);
    }

    protected function select(): \PDOStatement
    {
        return $this->find;
    }

    protected function selectAll(): \PDOStatement
    {
        return $this->findAll;
    }

    protected function getMapper(): Mapper
    {
        return $this;
    }

    public function findByEmail(String $email): ?Model
    {
        $this->findByEmail->execute([
            'email' => $email
        ]);
        $row = $this->findByEmail->fetch(); // TODO: Custom UserNotFoundException
        if ($row) {
            return $this->create($row);
        }
        return null;
    }
}