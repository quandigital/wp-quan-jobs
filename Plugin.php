<?php

namespace QuanDigital\Jobs;

use QuanDigital\WpLib\Boilerplate;
use QuanDigital\WpLib\CreateCpt;

class Plugin extends Boilerplate
{
    protected $postType = 'quan_jobs';

    public function __construct($file)
    {
        parent::__construct($file);

        $this->createCpt();

        \add_filter('archive_template', [$this, 'archiveTemplate']);
        \add_filter('single_template', [$this, 'singleTemplate']);

        \add_action('init', [$this, 'addSingleRewrite']);
        \add_action('init', [$this, 'addArchiveRewrite']);
        \add_filter('post_type_link', [$this, 'filterPostLink'], 10, 2);

        if (\is_admin()) {
            $this->registerScript();
            $this->jobAddressInfo();
        }
    }

    private function createCpt()
    {
        new CreateCpt($this->postType, 'Job Opening', 'Job Openings', 'dashicons-money');
    }

    private function registerScript()
    {
        \add_action( 'admin_enqueue_scripts', function() {
            $screen = \get_current_screen();
            if ($screen->post_type == $this->postType) {
                \QuanDigital\WpLib\Helpers::log(plugin_dir_url( __FILE__ ) . 'quan-jobs.js');
                \wp_enqueue_script('quan_admin_jobs', plugin_dir_url( __FILE__ ) . 'quan-jobs.js', array('jquery'), '1.0');
            }
        });
    }

    private function jobAddressInfo()
    {
        add_action('wp_ajax_quanJobUserId', function() {
            $user = get_user_by('id', $_GET['userId']);
            $response = [];
            $response['mail'] = $user->user_email;
            $response['phone'] = get_user_meta($user->ID, 'quan_phonenumber', true);

            echo json_encode($response);
            wp_die();
        });
    }

    public function addArchiveRewrite()
    {
        \add_rewrite_rule('jobs', 'index.php?post_type=' . $this->postType, 'top');
    }

    public function addSingleRewrite()
    {
        $query = new \WP_Query(['post_type' => $this->postType, 'posts_per_page' => -1]);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                if ($query->post->post_type == $this->postType) {
                    \add_rewrite_rule('job/(.*?)$', 'index.php?' . $query->post->post_type . '=$matches[1]', 'top');
                }
            }
        }
    }
    
    public function filterPostLink($post_link, $post)
    {
        if ($post->post_type === $this->postType && $post->post_status === 'publish') {
            $post_link = str_replace('/' . $post->post_type . '/', '/job/', $post_link);
        }
     
        return $post_link;   
    }

    public function archiveTemplate($template)
    {
        if (is_post_type_archive($this->postType)) {
            $archive_template = __DIR__ . '/templates/archive-template.php';
        }

        return $archive_template;
    }

    public function singleTemplate($template)
    {
        if (\get_post_type(\get_the_id()) === $this->postType) {
            $template = __DIR__ . '/templates/single-template.php';
        }

        return $template;
    }

}
