<?php

namespace Etl\Storage;

use Etl\Model\Model;

interface StorageInterface
{
    public function connect();

    public function disconnect();

    public function create();

    /**
     * @return int|null
     */
    public function count();

    public function getName();

    /**
     * Get one item from the storage in raw format
     *
     * @return array
     */
    public function fetch();

    public function fetchAll();
}
