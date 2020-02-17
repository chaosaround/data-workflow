<?php

namespace Etl\Extractor;

use Etl\Model\Model;
use Etl\Storage\ExternalStorageInterface;
use Etl\Storage\QueryableStorageInterface;
use Etl\Storage\WritableStorageInterface;
use Etl\Storage\StorageInterface;

abstract class Extractor implements ExtractorInterface
{
    protected $model;
    /**
     * @var StorageInterface
     */
    protected $externalStorage;
    protected $internalStorage;

    public function __construct(Model $model, ExternalStorageInterface $es, WritableStorageInterface $is)
    {
        $this->model           = $model;
        $this->externalStorage = $es;
        $this->internalStorage = $is;
    }



    /*
     *
     * CREATE TABLE [dbo].[Foo](
     * [bar] [nvarchar](50) NOT NULL
     * )
     *
     * ALTER TABLE [dbo].[Foo] WITH CHECK
     * ADD  CONSTRAINT [CK_Foo] CHECK  ((Len(RTrim([bar])) > 0))
     */
}
