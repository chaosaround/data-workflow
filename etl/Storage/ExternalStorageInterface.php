<?php

namespace Etl\Storage;

interface ExternalStorageInterface extends StorageInterface
{
    // determine sche
    public function determineSchema();
}
