<?php
/**
 * @license MIT
 *
 * Modified by CrochetFeve0251 on 18-July-2024 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace NoobPress\Dependencies\League\Container\Exception;

use NoobPress\Dependencies\Psr\Container\NotFoundExceptionInterface;
use InvalidArgumentException;

class NotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
}
