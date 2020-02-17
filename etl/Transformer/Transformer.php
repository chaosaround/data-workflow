<?php

namespace Etl\Transformer;

use Etl\Storage\InternalStorageInterface;
use Etl\Storage\QueryableStorageInterface;

abstract class Transformer implements TransformerInterface
{
    /**
     * @var InternalStorageInterface $internalStorage
     */
    protected $internalStorage;

    public function __construct(InternalStorageInterface $wfStorage)
    {
        $this->internalStorage = $wfStorage;
    }

    /**
     * @param InternalStorageInterface[] $storages
     */
    public function transform($storages)
    {
        // get one (main WF's storage) or + more storages
        // ??? initialize these storages
        // ! all storages should be of the same type (as main internal one)

        // recieve the SELECT query for all the storages of this transformer
        // process the SELECT query for INSERT support
        // create new storage and execute
        // transaction INSERT-SELECT

        $select = $this->select($storages);

        /*

            *
            *
            *
           begin transaction ;
           create table new_table                       -- create the table
           as
           select v.*
           from (select ....) as v                      -- as before
           where false ;                                -- but insert 0 rows

           alter table new_table add constraint ... ;   -- add the constraint

           insert into new_table                        -- and then attempt
           select ... ;                                 -- the insert
        end ;
            *
            */
    }

    // ??? is this method has names of storages of storages themselves

    /**
     * @param InternalStorageInterface[] $storages
     *
     * @return string
     */
    abstract public function select($storages): string;
}
