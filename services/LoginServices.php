<?php

namespace app\services;

use app\core\Model;
use app\exceptions\IncorrectLoginException;
use app\mappers\UserMapper;

class LoginServices
{
    public function login(array $body): bool
    {
        try {
            $user = $this->isUserExists($body['email']);
            if ($user && $this->isPasswordEquals($body['password'], $user->getPassword())){
                setcookie('PHP_AUTH_USER_ID', $user->getId());
                return true;
            } else {
                throw new IncorrectLoginException("Incorrect mail or password");
            }
        } catch (IncorrectLoginException $e) {
            echo $e;
            return false;
        }
    }

    public function isUserExists(String $email): ?Model
    {
        try {
            return (new UserMapper())->findByEmail($email);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function isPasswordEquals(String $enteredPassword, String $correctPassword): bool
    {
        if (strcmp($enteredPassword, $correctPassword) === 0) {
            return true;
        } else {
            return false;
        }
    }

}