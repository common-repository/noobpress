<?php
/**
 * @license MIT
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace NoobPress\Dependencies\League\Container\ServiceProvider;

use IteratorAggregate;
use NoobPress\Dependencies\League\Container\ContainerAwareInterface;

interface ServiceProviderAggregateInterface extends ContainerAwareInterface, IteratorAggregate
{
    /**
     * Add a service provider to the aggregate.
     *
     * @param string|ServiceProviderInterface $provider
     *
     * @return self
     */
    public function add($provider) : ServiceProviderAggregateInterface;

    /**
     * Determines whether a service is provided by the aggregate.
     *
     * @param string $service
     *
     * @return boolean
     */
    public function provides(string $service) : bool;

    /**
     * Invokes the register method of a provider that provides a specific service.
     *
     * @param string $service
     *
     * @return void
     */
    public function register(string $service);
}
