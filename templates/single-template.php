<?php
	
//job openings

get_header();
if( have_posts() ) : 
	while (have_posts()) : 
		the_post(); 
?>
		<div class="content">
			<article>
				<h1><?= get_the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		</div>
<?php
	endwhile; 
endif; 
	
get_sidebar( 'jobs' );

get_footer();