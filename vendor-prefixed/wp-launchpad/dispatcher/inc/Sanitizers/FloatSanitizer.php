<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\LaunchpadDispatcher\Sanitizers;

use NoobPress\Dependencies\LaunchpadDispatcher\Interfaces\SanitizerInterface;
use NoobPress\Dependencies\LaunchpadDispatcher\Traits\IsDefault;

class FloatSanitizer implements SanitizerInterface {
    use IsDefault;

    public function sanitize($value)
    {
        return (float) $value;
    }

}