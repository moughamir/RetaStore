<?php
/*
* Template Name: Blog Grid 4 Columns
*/

get_header(); ?>
<div class="container">
	<?php dw_store_breadcrumbs(); ?>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				$custom_query_args = array( 'post_type' => 'post', 'posts_per_page' => 12, 'ignore_sticky_posts' => true );
				$custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$custom_query = new WP_Query( $custom_query_args );
				$temp_query = $wp_query;
				$wp_query   = NULL;
				$wp_query   = $custom_query;
			?>
			<?php if ( $custom_query->have_posts() ) : ?>
				<div class="row masonry-container">
				<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
					<div class="col-sm-3 masonry-item">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
				<?php endwhile; ?>
				</div>
				<?php dw_store_posts_navigation(); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
			<?php
				wp_reset_postdata();
				$wp_query = NULL;
				$wp_query = $temp_query;
			?>
		</main>
	</div>
</div>
<?php get_footer(); ?>
