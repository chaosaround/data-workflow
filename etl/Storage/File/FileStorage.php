<?php

namespace Etl\Storage\File;

use Etl\Storage\ExternalStorageInterface;
use Etl\Storage\StorageInterface;
use Etl\Storage\WritableStorageInterface;

abstract class FileStorage implements
    StorageInterface,
    WritableStorageInterface,
    ExternalStorageInterface,
    TextFileStorageInterface
{

    /**
     * @var string $path
     */
    private $path;

    /**
     * @var resource $fileResource
     */
    protected $fileResource;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function connect()
    {
        $this->open();
    }

    public function disconnect()
    {
        // close file stream
    }

    public function create()
    {
        // create new file with
    }

    public function open() {
        // open file resource
        $this->fileResource = fopen($this->path, "a+");
        // @todo file modes settings
    }

    public function close() {

    }

    public function getName()
    {
        //
    }

    public function readLine(): string {

    }

    public function readAll(): string {

    }

    public function writeLine(string $line)
    {
        // TODO: Implement writeLine() method.
    }

    public function writeAll(string $text)
    {
        // TODO: Implement writeAll() method.
    }

    public function countLines(): int
    {
        // TODO: Implement countLines() method.
    }

    public function getClone()
    {
        // TODO: Implement getClone() method.
    }
}
