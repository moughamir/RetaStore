<?php if (!defined('FW')) die('Forbidden'); ?>
<?php
$numbers = isset( $atts['numbers'] ) ? $atts['numbers'] : 9;
$cat_id = isset( $atts['cat_id'] ) ? $atts['cat_id'] : '';
$tag_id = isset( $atts['tag_id'] ) ? $atts['tag_id'] :'';


$custom_query_args = array(
	'post_type' => 'product',
	'posts_per_page' => $numbers,
	);

if ( $tag_id && $cat_id ) {
	$custom_query_args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'product_cat',
			'field' => 'id',
			'terms' => $cat_id,
			),
		array(
			'taxonomy' => 'product_tag',
			'field' => 'id',
			'terms' => $tag_id,
			),
		);
} else {
	if ( $tag_id ) {
		$custom_query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_tag',
				'field' => 'id',
				'terms' => $tag_id,
				)
			);
	}

	if ( $cat_id ) {
		$custom_query_args['product_cat'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $cat_id,
				)
			);
	}
}


$custom_query = new WP_Query( $custom_query_args );
?>
<?php if ( $custom_query->have_posts() ) : ?>
	<?php
	$i = 0;
	$thumb_items = '';
	$carousel_items = '';
	?>
	<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
	<?php
	$product = new WC_Product( get_the_ID() );
	if ( 0 == $i ) {
		$selected = 'class="selected"';
		$active = 'active';
	} else {
		$selected = '';
		$active = '';
	}
	$thumb_items .= '<li class="col-md-4 col-sm-4 "> <a id="carousel-selector-'.$i.'" '.$selected.'>'.get_the_post_thumbnail(get_the_ID(),'thumbnail', array('class'=>'img-responsive')).'</a></li>';
	$carousel_items .= '<div class="item '.$active.'" data-slide-number="'.$i.'">
	<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'
	<div class="product-info">
	<h3 class="product-title">'.get_the_title().'</h3>
	'.$product->get_price_html().'
	'.$product->get_rating_html().'
	</div>
	</a>
	</div>';
	?>
	<?php $i++; ?>
<?php endwhile; ?>


<div class="products-slider">
	<div class="row">
		<div id="slider" class="col-md-6">
			<div class="wrap-slider">
				<div id="carousel-bounding-box">
					<div id="myCarousel" class="carousel slide">
						<!-- main slider carousel items -->
						<div class="carousel-inner">
							<?php echo $carousel_items; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="hidden-sm hidden-xs col-md-6 slider-list-products" id="slider-thumbs">

			<ul class="list-inline row ">
				<?php echo $thumb_items; ?>
			</ul>
		</div>
	</div>
</div>

<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
