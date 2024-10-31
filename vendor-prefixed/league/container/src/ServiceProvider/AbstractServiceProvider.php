<?php
/**
 * @license MIT
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace NoobPress\Dependencies\League\Container\ServiceProvider;

use NoobPress\Dependencies\League\Container\ContainerAwareTrait;

abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    use ContainerAwareTrait;

    /**
     * @var array
     */
    protected $provides = [];

    /**
     * @var string
     */
    protected $identifier;

    /**
     * {@inheritdoc}
     */
    public function provides(string $alias) : bool
    {
        return in_array($alias, $this->provides, true);
    }

    /**
     * {@inheritdoc}
     */
    public function setIdentifier(string $id) : ServiceProviderInterface
    {
        $this->identifier = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier() : string
    {
        return $this->identifier ?? get_class($this);
    }
}
