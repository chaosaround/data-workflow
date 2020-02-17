<?php

namespace Container\Exception;

use Container\Psr\NotFoundExceptionInterface;

/**
 * The ParameterNotFoundException is thrown when the container is asked to
 * provide a parameter that has not been defined.
 */
class ParameterNotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
