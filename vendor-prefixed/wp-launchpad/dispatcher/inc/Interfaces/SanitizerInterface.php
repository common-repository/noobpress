<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadDispatcher\Interfaces;

interface SanitizerInterface
{
    public function sanitize($value);

    public function is_default($value, $original): bool;
}