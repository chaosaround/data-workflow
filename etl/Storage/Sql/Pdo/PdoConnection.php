<?php

namespace Etl\Storage\Sql\Pdo;

use PDO;
use PDOException;
use RuntimeException;

class PdoConnection
{
    /**
     * @var PDO $connection
     */
    protected $connection;

    public function __construct(
        string $dsn,
        string $username = null,
        string $password = null,
        array $driverOptions = []
    ) {
        // if there is a PDO object already, return early
        if ($this->connection) {
            return;
        }

        try {
            $this->connection = new PDO($dsn, $username, $password, $driverOptions);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function getPdo()
    {
        if ($this->connection === null) {
            throw new PDOException("There is no PDO object for use.");
        }

        return $this->connection;
    }

    protected function disconnect()
    {
        $this->connection = null;
    }

    public function __destruct()
    {
        $this->disconnect();
    }
}
