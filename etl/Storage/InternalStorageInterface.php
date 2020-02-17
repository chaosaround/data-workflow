<?php

namespace Etl\Storage;

use Etl\Model\Model;

interface InternalStorageInterface extends StorageInterface, WritableStorageInterface, QueryableStorageInterface
{
    // or set validation schema method ???
    public function setSchema(Model $model);
}
