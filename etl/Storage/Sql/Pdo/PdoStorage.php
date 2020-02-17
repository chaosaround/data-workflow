<?php

namespace Etl\Storage\Sql\Pdo;

use Etl\Storage\ExternalStorageInterface;
use Etl\Model\Model;
use Etl\Storage\WritableStorageInterface;
use PDO;
use PDOStatement;
use PDOException;
use RuntimeException;
use Etl\Storage\QueryableStorageInterface;
use Etl\Storage\StorageInterface;
use Etl\Storage\InternalStorageInterface;

class PdoStorage implements
    StorageInterface,
    WritableStorageInterface,
    QueryableStorageInterface,
    InternalStorageInterface,
    ExternalStorageInterface
{

    /**
     * @var string $name
     */
    public $name;

    protected $config = [];

    /**
     * @var PdoConnection $connection
     */
    protected $connection;

    /**
     * @var PDOStatement
     */
    protected $statement;

    // ????? WHAT TO DO WITH IT?
    protected $fetchMode = PDO::FETCH_ASSOC;

    public function __construct(
        string $dsn,
        string $username = null,
        string $password = null,
        array $driverOptions = []
    ) {
        $this->config = compact("dsn", "username", "password", "driverOptions");
    }

    public function setSchema(Model $model)
    {
        // TODO: Implement setSchema() method.
    }

    public function determineSchema()
    {
        // FOR USING THIS STORAGE AS EXTERNAL
        // NOT IMPLEMENTED YET
        // TODO: Implement determineSchema() method.
    }

    public function count()
    {
        //
    }

    public function getClone()
    {

        // create new table in the same DB
        // return new storage with this table name
    }

    public function getName()
    {
        //
    }

    public function create()
    {
        /*
         * if database is specified
         *      create new table
         * else
         *      create database
         *      create new table
         * keep the db.table name somewhere
         */
    }

    public function connect()
    {
        $this->connection = new PdoConnection(
            $this->config["dsn"],
            $this->config["username"],
            $this->config["password"],
            $this->config["driverOptions"]
        );
    }

    public function disconnect()
    {
        $this->connection = null;
    }

    public function prepare(...$params)
    {
        // TODO: Implement prepare() method.
    }

    public function execute(...$params)
    {
        // TODO: Implement execute() method.
    }

    public function fetch()
    {
        // TODO: Implement fetch() method.
    }

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    public function insert(Model $item)
    {
        // TODO: Implement insert() method.
    }

    public function pdoGetStatement()
    {
        if ($this->statement === null) {
            throw new PDOException("There is no PDOStatement object for use.");
        }

        return $this->statement;
    }

    public function pdoPrepare($sql, array $options = array())
    {
        $this->connect();
        try {
            $this->statement = $this->connection->getPdo()->prepare($sql, $options);

            return $this;
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function pdoExecute(array $parameters = array())
    {
        try {
            $this->pdoGetStatement()->execute($parameters);

            return $this;
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function pdoCountAffectedRows()
    {
        try {
            return $this->pdoGetStatement()->rowCount();
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function pdoGetLastInsertId($name = null)
    {
        $this->connect();

        return $this->connection->getPdo()->lastInsertId($name);
    }

    public function pdoFetch($fetchStyle = null, $cursorOrientation = null, $cursorOffset = null)
    {
        if ($fetchStyle === null) {
            $fetchStyle = $this->fetchMode;
        }

        try {
            return $this->pdoGetStatement()->fetch($fetchStyle, $cursorOrientation, $cursorOffset);
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function pdoFetchAll($fetchStyle = null, $column = 0)
    {
        if ($fetchStyle === null) {
            $fetchStyle = $this->fetchMode;
        }

        try {
            return $fetchStyle === PDO::FETCH_COLUMN
                ? $this->pdoGetStatement()->fetchAll($fetchStyle, $column)
                : $this->pdoGetStatement()->fetchAll($fetchStyle);
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function pdoInsert($table, array $bind)
    {
        $cols   = implode(", ", array_keys($bind));
        $values = implode(", :", array_keys($bind));
        foreach ($bind as $col => $value) {
            unset($bind[$col]);
            $bind[":" . $col] = $value;
        }

        $sql = "INSERT INTO " . $table
               . " (" . $cols . ")  VALUES (:" . $values . ")";

        $this->pdoPrepare($sql);
        $this->pdoExecute($bind);
        return (int) $this->pdoGetLastInsertId();
    }
}
