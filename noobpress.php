<?php
/**
 * Plugin Name: NoobPress
 * Author: COQUARD Cyrille
 * Description: NoobPress is a plugin here to help beginner user by providing some basic feature any user should have.
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires PHP: 7.2
 * Requires at least: 5.8
 * Text Domain: noobpress
 * Domain Path: /languages
 */
use function NoobPress\Dependencies\LaunchpadCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/vendor-prefixed/wp-launchpad/core/inc/boot.php';

boot(__FILE__);
