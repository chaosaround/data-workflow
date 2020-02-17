<?php

namespace Etl\Extractor;

use Etl\Model\Model;
use Etl\Storage\File\DelimitedFileStorage;
use Etl\Storage\File\FileStorage;
use Etl\Storage\WritableStorageInterface;

class CsvExtractor extends FileExtractor
{
    // separator ?
    public function __construct(Model $model, DelimitedFileStorage $es, WritableStorageInterface $is)
    {
        parent::__construct($model, $es, $is);
    }

    public function extract()
    {
        // get all from File $es and

        return $this->internalStorage;
    }
}
