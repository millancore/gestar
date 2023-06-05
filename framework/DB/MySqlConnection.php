<?php

namespace Framework\DB;

use Framework\DB\Exception\ConnectionException;
use Framework\DB\Exception\QueryException;
use mysqli;

class MySqlConnection
{
    private mysqli $connection;

    /**
     * @throws ConnectionException
     */
    public function __construct(
        private string $host,
        private string $user,
        private string $password,
        private string $database,
    )
    {
        $this->connection = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database,
        );

        if ($this->connection->connect_errno) {
            throw new Exception\ConnectionException(
                $this->connection->connect_error,
                $this->connection->connect_errno,
            );
        }
    }

    /**
     * @throws QueryException
     */
    public function exec(QueryBuilder $builder): array
    {
        $result = $this->connection->query($builder->getQuery());

        if ($result === false) {
            throw new Exception\QueryException(
                $this->connection->error,
                $this->connection->errno,
            );
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function __destruct()
    {
        $this->connection->close();
    }

}