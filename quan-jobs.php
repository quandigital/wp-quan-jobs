<?php

namespace QuanDigital\Jobs;

/**
 * Plugin Name: Quan Job Listings
 * Plugin URI: https://github.com/quandigital/wp-quan-jobs
 * Author: Quan Digital GmbH
 * Author URI: http://www.quandigital.com/
 * Description: Adds a custom post types for jobs
 * Version: 1.1.1
 * License: MIT
 */

defined('ABSPATH') or die();
include ABSPATH . '../../vendor/autoload.php';

use QuanDigital\WpLib\Autoload;

new Autoload(__DIR__, __NAMESPACE__);

new Plugin(__FILE__);
