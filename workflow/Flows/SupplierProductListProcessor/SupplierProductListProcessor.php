<?php

namespace Workflow\Flows\SupplierProductListProcessor;

use Container\Reference\ServiceReference as SR;
use Container\Reference\ParameterReference as PR;
use Etl\Extractor\CsvExtractor;
use Etl\Workflow\Workflow;

class SupplierProductListProcessor extends Workflow
{

    // parameters for validation check and for help
    public static $parameters = [
        'csv-path'
    ];

    // send progress numbers to the log
    protected $progress = true;

    protected static function registerExtractorServices()
    {
        // define storages with parameters
        return [
            // how we will pass the path to
            CsvExtractor::class => [
                'class'     => CsvExtractor::class,
                'arguments' => [
                    new PR('csv-file-path'),
                    new PR('csv-separator-char'),
                    new PR('csv-quote-char'),
                    new SR(ProductModel::class),
                    new class
                    {
                        protected $required = [
                            'brand_name',
                            'model_name',
                        ];

                        public $brand_name;
                        public $model_name;
                        public $condition_name;
                        public $grade_name;
                        public $gb_spec_name;
                        public $colour_name;
                        public $network_name;
                    }
                ]
            ]
        ];
    }

    protected static function registerTransformerServices()
    {
        return [
            Transformer1::class
        ];
    }

    protected static function registerLoaderServices()
    {
        return [];
    }

    public function run()
    {
        $this->extract(CsvExtractor::class);
        $this->transform(Transformer1::class);

        $ds1 = $this->transform("T2")->getStorageClone();
        $ds2 = $this->transform("T3")->getStorageClone();

        $this->load("L2", $ds2);
        $this->transform("T4", $ds1, $ds2);
        $this->load("L1");
    }
}
