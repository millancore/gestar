<?php

namespace Framework\DB;

class QueryBuilder
{
    private string $sql;

    public function insert(string $table, array $data): self
    {
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_values($data));

        $this->sql = "INSERT INTO $table ($fields) VALUES ($values)";

        return $this;
    }

    public function select(string $table, array $fields = ['*']): self
    {
        $this->sql = "SELECT " . implode(', ', $fields) . " FROM $table";

        return $this;
    }

    public function where(string $field, string $operator, mixed $value): self
    {
        $this->sql .= " WHERE $field $operator '$value'";

        return $this;
    }

    public function andWhere(string $field, string $operator, mixed $value): self
    {
        $this->sql .= " AND $field $operator '$value'";

        return $this;
    }

    public function orWhere(string $field, string $operator, mixed $value): self
    {
        $this->sql .= " OR $field $operator '$value'";

        return $this;
    }

    public function orderBy(string $field, string $direction = 'ASC'): self
    {
        $this->sql .= " ORDER BY $field $direction";

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->sql .= " LIMIT $limit";

        return $this;
    }

    public function getQuery(): string
    {
        return $this->sql;
    }

}