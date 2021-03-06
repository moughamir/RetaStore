<?php
/*
* Template Name: Blog Right Sidebar
*/

get_header(); ?>
<div class="container">
	<?php dw_store_breadcrumbs(); ?>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<div class="row">
		<div class="<?php dw_store_primary_column_class(); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php
						$custom_query_args = array( 'post_type' => 'post' );
						$custom_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						$custom_query = new WP_Query( $custom_query_args );
						$temp_query = $wp_query;
						$wp_query   = NULL;
						$wp_query   = $custom_query;
					?>
					<?php if ( $custom_query->have_posts() ) : ?>
						<div class="row masonry-container">
						<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
							<div class="col-sm-12 masonry-item">
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
		<div class="<?php dw_store_secondary_column_class(); ?>">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
