<?php

namespace QuanDigital\Jobs;

use QuanDigital\WpLib\Autoload;

/**
 * Plugin Name: Quan Job Listings
 * Plugin URI: https://github.com/quandigital/wp-quan-jobs
 * Author: Quan Digital GmbH
 * Author URI: http://www.quandigital.com/
 * Description: Adds a custom post types for jobs
 * Version: 1.1.3
 * License: MIT
 */

new Autoload(__DIR__, __NAMESPACE__);

new Plugin(__FILE__);
