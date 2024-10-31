<?php
/**
 * @license MIT
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace NoobPress\Dependencies\League\Container\Argument;

use NoobPress\Dependencies\League\Container\ContainerAwareInterface;
use ReflectionFunctionAbstract;

interface ArgumentResolverInterface extends ContainerAwareInterface
{
    /**
     * Resolve an array of arguments to their concrete implementations.
     *
     * @param array $arguments
     *
     * @return array
     */
    public function resolveArguments(array $arguments) : array;

    /**
     * Resolves the correct arguments to be passed to a method.
     *
     * @param ReflectionFunctionAbstract $method
     * @param array                      $args
     *
     * @return array
     */
    public function reflectArguments(ReflectionFunctionAbstract $method, array $args = []) : array;
}
