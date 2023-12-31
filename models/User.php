<?php

declare(strict_types=1);

namespace app\models;

use app\core\Model;

class User extends Model
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password, int $id = null)
    {
        parent:: __construct($id);
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}