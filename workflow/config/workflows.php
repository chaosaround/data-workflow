<?php

use Container\Reference\ParameterReference as PR;
use Container\Reference\ServiceReference as SR;

use Workflow\Flows\SupplierProductListProcessor\SupplierProductListProcessor;

// REGISTER WORKFLOWS HERE!!!!
return [
    'SupplierProductListProcessor' => [
        'class' => SupplierProductListProcessor::class
    ]
];


//		'calls' => [
//			[
//				'method' => 'methodname',
//				'arguments' => [
//					,
//				]
//			],
//		]
