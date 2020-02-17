<?php

require_once __DIR__ . '/../vendor/autoload.php';

// PARAMS
$parameters = include __DIR__ . '/config/parameters.php';

// TODO to create classes to work with console and parameters
$parameters['csv-path'] = 'file.csv';

// TODO to create WorkflowRunner class and so on
// WORKFLOWS
$workflows  = include __DIR__ . '/config/workflows.php';

foreach ($workflows as $workflow) {
    if (!isset($workflow['arguments']) || empty($workflow['arguments'])) {
        $workflow['arguments'] = [
            new \Container\Reference\ParameterReference('workflow.storage.default')
        ];
    }
}

$defaultWorkflow = $workflows[0];

$workflowServiceToRun = $defaultWorkflow;

/**
 * @var string|\Etl\Workflow\Workflow $workflowClassToRun
 * This is not an object, only the name of current workflow class as string
 */
$workflowClassToRun = $workflowServiceToRun['class'];

$services = array_merge($workflows, $workflowClassToRun::getRegisteredServices());

$container = new Container\Container($workflows, $parameters);

/**
 * @var \Etl\Workflow\Workflow $workflow
 */
$workflow = $container->get($workflowServiceToRun);
$workflow->run();
