<?php

namespace app\core;

use PDO;
use PDOException;
use Psr\Log\LogLevel;

class Database
{
    public PDO $pdo;

    /**
     * @param string $DbDsn
     * @param string $DbUser
     * @param string $DbPassword
     */
    public function __construct(string $DbDsn, string $DbUser, string $DbPassword)
    {
        try {
            $this->pdo = new PDO($DbDsn, $DbUser, $DbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Application::$app->logger->log(LogLevel::ERROR, $e->getMessage());
        }
    }
}