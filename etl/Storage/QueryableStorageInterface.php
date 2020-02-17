<?php

namespace Etl\Storage;

interface QueryableStorageInterface
{
    public function prepare(...$params);

    public function execute(...$params);
}
