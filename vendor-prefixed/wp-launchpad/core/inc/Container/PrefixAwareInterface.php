<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadCore\Container;

interface PrefixAwareInterface {
	/**
	 * Set the plugin prefix.
	 *
	 * @param string $prefix Plugin prefix.
	 * @return void
	 */
	public function set_prefix( string $prefix ): void;
}
