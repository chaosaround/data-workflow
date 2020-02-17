<?php

namespace Etl\Loader;

use Etl\Model\Model;
use Etl\Storage\ExternalStorageInterface;

interface LoaderInterface
{
    public function load(ExternalStorageInterface $storage);
}
