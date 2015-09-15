<?php

namespace QuanDigital\Jobs;

/**
 * Plugin Name: Quan Job Listings
 * Plugin URI: http://www.quandigital.com/
 * Description: Adds a custom post types for jobs
 * Version: 1.1.0
 * License: MIT
 */

defined('ABSPATH') or die();
include ABSPATH . '../../vendor/autoload.php';

use QuanDigital\WpLib\Autoload;

new Autoload(__DIR__, __NAMESPACE__);

new Plugin(__FILE__);
