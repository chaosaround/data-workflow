<?php

namespace Etl\Extractor;

use Etl\Storage\QueryableStorageInterface;

interface ExtractorInterface
{
    // get everything from ES
    // (determines source schema or according to the specified Model)
    // and put into IS
    /**
     * @return QueryableStorageInterface
     */
    public function extract();
}
