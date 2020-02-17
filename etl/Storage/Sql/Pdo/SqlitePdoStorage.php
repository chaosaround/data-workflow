<?php

namespace Etl\Storage\Sql\Pdo;

class SqlitePdoStorage extends PdoStorage
{
    public function __construct(
        string $dsn,
        string $username = null,
        string $password = null,
        array $driverOptions = []
    ) {
        parent::__construct($dsn, $username, $password, $driverOptions);
    }
}
