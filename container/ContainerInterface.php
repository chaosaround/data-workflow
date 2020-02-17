<?php

namespace Container;

use Container\Exception\ContainerException;

/**
 * The container interface. This extends the interface defined by
 * `container-interop` to include methods for retrieving parameters.
 */
interface ContainerInterface extends Psr\ContainerInterface
{
    /**
     * Retrieve a parameter from the container.
     *
     * @param string $name The parameter name.
     *
     * @return mixed The parameter.
     *
     * @throws ContainerException On failure.
     */
    public function getParameter($name);

    /**
     * Check to see if the container has a parameter.
     *
     * @param string $name The parameter name.
     *
     * @return bool True if the container has the parameter, false otherwise.
     */
    public function hasParameter($name);
}
