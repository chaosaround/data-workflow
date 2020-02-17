<?php

namespace Etl\Storage\File;

interface TextFileStorageInterface
{
    public function countLines(): int;
    public function readLine(): string;
    public function readAll(): string;
    public function writeLine(string $line);
    public function writeAll(string $text);
}
