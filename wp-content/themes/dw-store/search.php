<?php get_header(); ?>
<div class="container">
	<?php dw_store_breadcrumbs(); ?>
	<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'dw-store' ), get_search_query() ); ?></h1>
	<div class="row">
		<div class="<?php dw_store_primary_column_class(); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'search' ); ?>
					<?php endwhile; ?>
					<?php dw_store_posts_navigation(); ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
				</main>
			</div>
		</div>
		<div class="<?php dw_store_secondary_column_class(); ?>">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
