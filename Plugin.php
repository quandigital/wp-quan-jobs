<?php

namespace QuanDigital\Jobs;

use QuanDigital\WpLib\Boilerplate;
use QuanDigital\WpLib\CreateCpt;

class Plugin extends Boilerplate
{
    public function __construct($file)
    {
        parent::__construct($file);

        // \add_action('init', function() {
            $this->createCpt();
        // });

        if (\is_admin()) {
            $this->registerScript();
            $this->jobAddressInfo();
        }
    }

    private function createCpt()
    {
        new CreateCpt('quan_jobs', 'Job Opening', 'Job Openings', 'dashicons-money');
    }

    private function registerScript()
    {
        \add_action( 'admin_enqueue_scripts', function() {
            $screen = \get_current_screen();
            if ($screen->post_type == 'quan_jobs') {
                \QuanDigital\WpLib\Helpers::log(plugin_dir_url( __FILE__ ) . 'quan-jobs.js');
                \wp_enqueue_script('quan_admin_jobs', plugin_dir_url( __FILE__ ) . 'quan-jobs.js', array('jquery'), '1.0');
            }
        });
    }

    private function jobAddressInfo()
    {
        add_action( 'wp_ajax_quanJobUserId', function() {
            $user = get_user_by('id', $_GET['userId']);
            $response = [];
            $response['mail'] = $user->user_email;
            $response['phone'] = get_user_meta($user->ID, 'quan_phonenumber', true);

            echo json_encode($response);
            wp_die();
        });
    }
}