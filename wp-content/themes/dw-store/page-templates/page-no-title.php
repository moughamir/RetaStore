<?php
/*
* Template Name: Page No Title
*/

get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php get_footer(); ?>
