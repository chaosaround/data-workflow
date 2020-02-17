<?php

namespace Etl\Model;

use Etl\Model\Type\IntegerType;

abstract class Model implements ModelInterface
{

    /**
     * @var string[]
     */
    protected $required = [];

    protected $types = [
        'id' => IntegerType::class
    ];

    // primary key
    // which column?
    // or to create it?
}
