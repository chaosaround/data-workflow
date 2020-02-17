<?php

namespace Etl\Transformer;

use Etl\Storage\InternalStorageInterface;

interface TransformerInterface
{

    public function transform($storages);
}
