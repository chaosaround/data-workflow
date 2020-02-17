<?php

namespace Etl\Extractor;

use Etl\Model\Model;
use Etl\Storage\File\FileStorage;
use Etl\Storage\WritableStorageInterface;

abstract class FileExtractor extends Extractor
{

    public function __construct(Model $model, FileStorage $es, WritableStorageInterface $is)
    {
        parent::__construct($model, $es, $is);
    }
}
