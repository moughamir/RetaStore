<?php get_header(); ?>
<div class="container">
	<?php dw_store_breadcrumbs(); ?>
	<div class="row">
		<div class="<?php dw_store_primary_column_class(); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail"><?php the_post_thumbnail(); ?></div>
					<?php endif; ?>
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							<div class="entry-meta">
								<?php dw_store_entry_meta(); ?>
							</div>
						</header>

						<div class="entry-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'dw-store' ),
									'after'  => '</div>',
								) );
							?>
						</div>
						<?php dw_store_entry_footer(); ?>
					</article>

					<div class="author-info">
						<div class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'dw_store_author_bio_avatar_size', 96 ) ); ?>
						</div>
						<div class="author-description">
							<h4><?php printf( __( 'About %s', 'dw-store' ), get_the_author() ); ?></h4>
							<p>
								<?php $author_description = apply_filters( 'the_content', get_the_author_meta( 'description' ) ); ?>
								<?php echo wp_kses( $author_description, wp_kses_allowed_html( 'pre_user_description' ) ); ?>
							</p>
							<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'dw-store' ), get_the_author() ); ?>
							</a>
						</div>
					</div>

					<?php the_post_navigation(); ?>
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
