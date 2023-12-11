<?php

declare(strict_types=1);

namespace app\core;

abstract class Mapper
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->database->pdo;
    }

    public function create(array $object): Model
    {
        return $this->doCreate($object);
    }

    public function update(Model $model): Model
    {
        return $this->doUpdate($model);
    }

    public function delete(Model $model): void
    {
        $this->doDelete($model);
    }

    public function insert(Model $model): Model
    {
        return $this->doInsert($model);
    }

    public function find(int $id): ?Model
    {
        $this->select()->execute([
            'id' => $id
        ]);
        $row = $this->select()->fetch();

        if (!is_array($row)) {
            return null;
        }

        if (!isset($row['id'])) {
            return null;
        }

        return $this->create($row);
    }

    public function findAll(): Collection
    {
        $this->selectAll()->execute();
        $rows = $this->selectAll()->fetchAll();

        return new Collection($rows, $this->getMapper());
    }

    /**
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    abstract protected function doInsert(Model $object): Model;
    abstract protected function doUpdate(Model $object): Model;
    abstract protected function doDelete(Model $object): void;
    abstract protected function doCreate(array $object): Model;
    abstract protected function select(): \PDOStatement;
    abstract protected function selectAll(): \PDOStatement;
    abstract protected function getMapper(): Mapper;

}