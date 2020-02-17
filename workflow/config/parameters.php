<?php

use Container\Reference\ParameterReference as PR;

return [
    'workflow' => [
        'storage' => [
            'default' => new PR(\Etl\Storage\Sql\Pdo\PdoStorage::class)
        ]
    ],
    'storage'  => [
        'dir' => __DIR__ . '/../storage',
    ],
];
