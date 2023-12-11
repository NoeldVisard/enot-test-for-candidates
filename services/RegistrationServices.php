<?php

namespace app\services;

use app\core\Application;
use app\core\Response;
use app\exceptions\FileSystemException;
use app\exceptions\IncorrectSignUpException;
use app\mappers\UserMapper;

class RegistrationServices
{
    public function register(string $password, string $password2, string $email)
    {
        try {
            $canRegister = $this->isPasswordsEquals($password, $password2) && $this->isMailNotExist($email);
            if ($canRegister) {
                $user = new User($email, $password);
                $mapper = new UserMapper();
                $mapper->insert($user);

                return 200;
            } else {
                throw new IncorrectSignUpException("Incorrect password or mail exists");
            }
        } catch (IncorrectSignUpException $e) {
            echo $e;
            return false;
        }
    }

    public function isPasswordsEquals(mixed $password, mixed $password2): bool
    {
        return $password === $password2;
    }

    public function isMailNotExist(string $email): bool
    {
        $userMapper = new UserMapper();
        return !((bool)$userMapper->findByEmail($email));
    }
}