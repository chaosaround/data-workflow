<?php

namespace Container\Exception;

use Container\Psr\NotFoundExceptionInterface;

/**
 * The ServiceNotFoundException is thrown when the container is asked to provide
 * a service that has not been defined.
 */
class ServiceNotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
