<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadDispatcher\Traits;

trait IsDefault
{
    public function is_default($value, $original): bool
    {
        return $value !== $original;
    }
}