<?php
/**
 * @license proprietary?
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */
declare(strict_types=1);

namespace NoobPress\Dependencies\LaunchpadOptions\Interfaces;

/**
 * Define mandatory methods to implement when using this package
 */
interface TransientsInterface
{
    /**
     * Gets the transient name used to store the transient in the WordPress database.
     *
     * @param string $name Unprefixed name of the transient.
     *
     * @return string
     */
    public function get_full_key( string $name): string;

    /**
     * Gets the transient for the given name. Returns the default value if the value does not exist.
     *
     * @param string $name   Name of the transient to get.
     * @param mixed  $default Default value to return if the value does not exist.
     *
     * @return mixed
     */
    public function get( string $name, $default = null );

    /**
     * Sets the value of an transient. Update the value if the transient for the given name already exists.
     *
     * @param string $name Name of the transient to set.
     * @param mixed $value Value to set for the transient.
     * @param int $expiration Time until expiration in seconds. Default 0 (no expiration).
     *
     * @return void
     */
    public function set( string $name, $value, int $expiration = 0 );

    /**
     * Deletes the transient with the given name.
     *
     * @param string $name Name of the transient to delete.
     *
     * @return void
     */
    public function delete( string $name );

    /**
     * Checks if the transient with the given name exists.
     *
     * @param string $name Name of the transient to check.
     *
     * @return bool
     */
    public function has( string $name ): bool;
}