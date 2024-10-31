<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadCore\Dispatcher;

use NoobPress\Dependencies\LaunchpadDispatcher\Dispatcher;

trait DispatcherAwareTrait {

	/**
	 * WordPress hooks dispatcher.
	 *
	 * @var Dispatcher
	 */
	protected $dispatcher;

	/**
	 * Setup WordPress hooks dispatcher.
	 *
	 * @param Dispatcher $dispatcher WordPress hooks dispatcher.
	 *
	 * @return void
	 */
	public function set_dispatcher( Dispatcher $dispatcher ): void {
		$this->dispatcher = $dispatcher;
	}
}
