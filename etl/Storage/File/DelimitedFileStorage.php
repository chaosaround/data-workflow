<?php

namespace Etl\Storage\File;

use Etl\Model\Model;

// e.g. CSV (commas), TSV (tabs), PSV (| - "pipe")
// storage within delimited text file
// each line of the file is a data record.
class DelimitedFileStorage extends FileStorage
{

    protected $delimeterChar = ',';

    protected $stringsQuoteChar = '"';

    protected $hasHeaderLine = true;

    public function __construct(string $path, $delimeterChar, $stringsQuoteChar, $hasHeaderLine)
    {
        parent::__construct($path);
    }

    public function determineSchema()
    {
        // TODO: Implement determineSchema() method.
    }

    public function setSchema(Model $model)
    {
        // TODO: Implement setSchema() method.
    }

    public function insert(Model $item)
    {
        // TODO: Implement insert() method.
    }

    public function fetch()
    {
        //$this->readLine();

        // TODO: Implement fetch() method.
    }

    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    public function count()
    {
        return $this->countLines();
    }
}
