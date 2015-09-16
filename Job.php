<?php

namespace QuanDigital\Jobs;

use QuanDigital\WpLib\Helpers;

class Job
{
    public function getAll()
    {
        $jobs = \wp_count_posts('quan_jobs');
        return Helpers::notEmpty($jobs) ? $jobs->publish : 0;
    }
}