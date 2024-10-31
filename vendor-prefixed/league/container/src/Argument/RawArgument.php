<?php
/**
 * @license MIT
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */ declare(strict_types=1);

namespace NoobPress\Dependencies\League\Container\Argument;

class RawArgument implements RawArgumentInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * Construct.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}
