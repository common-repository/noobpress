<?php

defined( 'ABSPATH' ) || exit;

return [
    \NoobPress\Dependencies\LaunchpadFrameworkOptions\ServiceProvider::class,
    \NoobPress\Security\Login\ServiceProvider::class,
    \NoobPress\Security\RPC\ServiceProvider::class,
    \NoobPress\ServiceProvider::class,
];
