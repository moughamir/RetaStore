<?php
/*
* Template Name: Page Right Sidebar
*/

get_header(); ?>
<div class="container">
	<?php dw_store_breadcrumbs(); ?>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<div class="row">
		<div class="<?php dw_store_primary_column_class(); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="page-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dw-store' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'dw-store' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div>

						<?php
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
					<?php endwhile; ?>
				</main>
			</div>
		</div>
		<div class="<?php dw_store_secondary_column_class(); ?>">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
