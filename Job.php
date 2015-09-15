<?php

namespace QuanDigital\Jobs;

class Job
{
    public function getAll()
    {
        $jobs = \wp_count_posts( 'quan_jobs' );
        
        return $jobs->publish;
    }
}