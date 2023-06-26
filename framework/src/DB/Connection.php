<?php

namespace Xfrmk\DB;

use PDO;
use PDOStatement;

final class Connection
{

    public function __construct(
       private PDO $connection
    )
    {
        //
    }

    public function prepare(string $query): PDOStatement
    {
        return $this->connection->prepare($query);
    }


    /**
     * @param string $query
     * @param array<string> $params
     * @return PDOStatement
     */
    public function execute(string $query, array $params = []): PDOStatement
    {

        $statement = $this->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    public function getLastInsertedId(): int
    {
        return (int) $this->connection->lastInsertId();
    }

}