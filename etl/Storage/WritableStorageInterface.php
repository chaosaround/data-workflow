<?php

namespace Etl\Storage;

use Etl\Model\Model;

interface WritableStorageInterface extends StorageInterface
{
    public function insert(Model $item);

    /**
     * @return StorageInterface
     */
    public function getClone();
}
