<?php

namespace Workflow\Flows\SupplierProductListProcessor;

use Etl\Model\Model;

class ProductModel extends Model
{

    protected $required = [
        'make',
        'model',
    ];

    public $make;
    public $model;
    public $colour;
    public $capacity;
    public $network;
    public $grade;
    public $condition;

}
