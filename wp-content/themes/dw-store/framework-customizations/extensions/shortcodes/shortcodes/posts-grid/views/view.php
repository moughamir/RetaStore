<?php if (!defined('FW')) die('Forbidden'); ?>
<?php
$numbers = isset( $atts['numbers'] ) ? $atts['numbers'] : 6;
$col_num = isset( $atts['col_num'] ) ? $atts['col_num'] : 3;
$tag_id = ( ! empty( $atts['tag_id'] ) ) ? $atts['tag_id'] : '';
$cat_id = ( ! empty( $atts['cat_id'] ) ) ? $atts['cat_id'] : '';
$show_date = isset ( $atts['show_date'] ) ? $atts['show_date'] : 1;
$show_author = isset ( $atts['show_author'] ) ? $atts['show_author'] : 1;
$show_comment = isset ( $atts['show_comment'] ) ? $atts['show_comment'] : 1;
$show_content = isset ( $atts['show_content'] ) ? $atts['show_content'] : 'excerpt';


$query = array(
	'posts_per_page' => intval( $numbers ),
	'post_type' => 'post',
	'no_found_rows' => true,
	'post_status' => 'publish',
	'ignore_sticky_posts' => true,
	);

if ( '' != $tag_id && '' != $cat_id ) {
	$query['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'category',
			'field' => 'id',
			'terms' => $cat_id,
			),
		array(
			'taxonomy' => 'post_tag',
			'field' => 'id',
			'terms' => $tag_id,
			),
		);
} else {
	if ( '' != $tag_id ) {
		$query['tag_slug__in'] = explode( ',', $tag_id );
	}
}

$r = new WP_Query( $query );
if ( $r->have_posts() ) :
?>
	<div class="posts-grid">
			<div class="row">
			<?php $col = 12 / $col_num; ?>
			<?php $i = 1; ?>
			<?php $item_count = $r->post_count; ?>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<div class="col-sm-<?php echo esc_attr( $col ); ?>">
					<article <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a></div>
							<?php endif; ?>
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<div class="entry-meta">
								<?php if ( $show_date ) : ?>
									<span class="entry-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></span>
								<?php endif; ?>
								<?php if ( $show_author ) : ?>
									<span class="entry-author"><i class="fa fa-user"></i> <?php the_author(); ?></span>
								<?php endif; ?>
								<?php if ( $show_comment && ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
									<span class="comments-link"><?php _e( '<i class="fa fa-comment"></i> ', 'dw-focus' ); ?><?php comments_popup_link( __( '0', 'dw-focus' ), __( '1', 'dw-focus' ), __( '%', 'dw-focus' ) ); ?></span>
								<?php endif; ?>
							</div>

							<?php
							if ( 'content' == $show_content ) :
							?>
								<div class="entry-content"><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dw-focus' ) ); ?></div>
							<?php elseif ( 'excerpt' == $show_content ) : ?>
								<div class="entry-summary"><?php the_excerpt(); ?></div>
							<?php endif; ?>
						</article>
						<?php if ( ( 0 === $i % ( $col_num ) ) && ( $i < $item_count ) ) : ?>
					</div>
					<div class="row">
					<?php endif; ?>
				</div>
			<?php $i++; ?>
			<?php endwhile; ?>

			</div>
</div>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
