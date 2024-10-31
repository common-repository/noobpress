<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadCore\Activation;

use NoobPress\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;
use NoobPress\Dependencies\LaunchpadCore\Container\HasInflectorInterface;
use NoobPress\Dependencies\LaunchpadCore\Container\PrefixAwareInterface;
use NoobPress\Dependencies\LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use NoobPress\Dependencies\LaunchpadDispatcher\Dispatcher;
use NoobPress\Dependencies\Psr\Container\ContainerInterface;

class Activation {

	/**
	 * Service providers.
	 *
	 * @var array
	 */
	protected static $providers = [];

	/**
	 * Parameters.
	 *
	 * @var array
	 */
	protected static $params = [];

	/**
	 * Container.
	 *
	 * @var ContainerInterface
	 */
	protected static $container;

	/**
	 * Hook dispatcher.
	 *
	 * @var Dispatcher
	 */
	protected static $dispatcher;

	/**
	 * Set service providers.
	 *
	 * @param array $providers Service providers.
	 * @return void
	 */
	public static function set_providers( array $providers ) {
		self::$providers = $providers;
	}

	/**
	 * Set parameters.
	 *
	 * @param array $params Parameters.
	 * @return void
	 */
	public static function set_params( array $params ) {
		self::$params = $params;
	}

	/**
	 * Set the container.
	 *
	 * @param ContainerInterface $container Container.
	 * @return void
	 */
	public static function set_container( ContainerInterface $container ) {
		self::$container = $container;
	}

	/**
	 * Set hook dispatcher.
	 *
	 * @param Dispatcher $dispatcher Hook dispatcher.
	 * @return void
	 */
	public static function set_dispatcher( Dispatcher $dispatcher ): void {
		self::$dispatcher = $dispatcher;
	}

	/**
	 * Performs these actions during the plugin activation
	 *
	 * @return void
	 */
	public static function activate_plugin() {

		$container = self::$container;

		foreach ( self::$params as $key => $value ) {
			self::$container->add( $key, $value );
		}

		$container->share( 'dispatcher', self::$dispatcher );

		$container->inflector( PrefixAwareInterface::class )->invokeMethod( 'set_prefix', [ key_exists( 'prefix', self::$params ) ? self::$params['prefix'] : '' ] );
		$container->inflector( DispatcherAwareInterface::class )->invokeMethod( 'set_dispatcher', [ $container->get( 'dispatcher' ) ] );

		$providers = array_filter(
			self::$providers,
			function ( $provider ) {
				if ( is_string( $provider ) ) {
					$provider = new $provider();
				}

				if ( ! $provider instanceof ActivationServiceProviderInterface && ( ! $provider instanceof HasInflectorInterface || count( $provider->get_inflectors() ) === 0 ) ) {
					return false;
				}

				return $provider;
			}
			);

		/**
		 * Activation providers.
		 *
		 * @param AbstractServiceProvider[] $providers Providers.
		 * @return AbstractServiceProvider[]
		 */
		$providers = apply_filters( "{$container->get('prefix')}deactivate_providers", $providers );

		$providers = array_map(
			function ( $provider ) {
				if ( is_string( $provider ) ) {
					return new $provider();
				}
				return $provider;
			},
			$providers
			);

		foreach ( $providers as $provider ) {
			self::$container->addServiceProvider( $provider );
		}

		foreach ( $providers as $service_provider ) {
			if ( ! $service_provider instanceof HasInflectorInterface ) {
				continue;
			}
			$service_provider->register_inflectors();
		}

		foreach ( $providers as $provider ) {
			if ( ! $provider instanceof HasActivatorServiceProviderInterface ) {
				continue;
			}

			foreach ( $provider->get_activators() as $activator ) {
				$activator_instance = self::$container->get( $activator );
				if ( ! $activator_instance instanceof ActivationInterface ) {
					continue;
				}
				$activator_instance->activate();
			}
		}
	}
}
