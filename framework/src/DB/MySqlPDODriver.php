<?php

namespace Xfrmk\DB;

use Xfrmk\DB\Exception\ConnectionException;
use PDO;
use PDOException;
use SensitiveParameter;

readonly class MySqlPDODriver
{
    public function __construct(
        private string $host,
        private string $user,
        #[SensitiveParameter]
        private string $password,
        private string $database,
    ) { }

    /**
     * Connect to database
     * @throws ConnectionException
     */
    public function connect(): PDO
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->database}",
                $this->user,
                $this->password,
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            throw new ConnectionException(
                $e->getMessage(),
                $e->getCode(),
            );
        }
    }

}