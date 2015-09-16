<?php

//custom index page for job openings at quan

get_header();

$jobs_query = new WP_Query(['post_type' => 'quan_jobs', 'posts_per_page' => -1]);
?>
    <div class="job-listings">
        <?php if( $jobs_query->have_posts() ) : ?>
            <h1><?= __( 'Job Openings at Quan Digital GmbH', 'quan' ); ?></h1>

            <?php while( $jobs_query->have_posts() ) : $jobs_query->the_post(); ?>
                    <article>
                        <h2><a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a></h2>
                        <?= quan_job_excerpt(); ?>
                    </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
<?php
get_footer();