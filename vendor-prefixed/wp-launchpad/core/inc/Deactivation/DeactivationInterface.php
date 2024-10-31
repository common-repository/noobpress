<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadCore\Deactivation;

interface DeactivationInterface {

	/**
	 * Executes this method on plugin deactivation
	 *
	 * @return void
	 */
	public function deactivate();
}
