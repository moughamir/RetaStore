<?php if (!defined('FW')) die('Forbidden'); ?>
<?php
$title = isset( $atts['title'] ) ? $atts['title'] : '';
$numbers = isset( $atts['numbers'] ) ? $atts['numbers'] : 5;
$tag_id = ( ! empty( $atts['tag_id'] ) ) ? $atts['tag_id'] : '';
$cat_id = ( ! empty( $atts['cat_id'] ) ) ? $atts['cat_id'] : '';
$show = isset( $atts['show'] ) ? $atts['show'] : '';
$orderby = isset( $atts['orderby'] ) ? $atts['orderby'] : '';
$order = isset( $atts['order'] ) ? $atts['order'] : '';
$hide_free = isset ( $atts['hide_free'] ) ? $atts['hide_free'] : 0;
$show_hidden = isset ( $atts['show_hidden'] ) ? $atts['show_hidden'] : 0;
$show_rating = isset ( $atts['show_rating'] ) ? $atts['show_rating'] : true;

$query_args = array(
	'posts_per_page' => $numbers,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'no_found_rows'  => 1,
	'order'          => $order,
	'meta_query'     => array()
	);

if ( $show_hidden == 0 ) {
	$query_args['meta_query'][] = WC()->query->visibility_meta_query();
	$query_args['post_parent']  = 0;
}

if ( $hide_free == 1 ) {
	$query_args['meta_query'][] = array(
		'key'     => '_price',
		'value'   => 0,
		'compare' => '>',
		'type'    => 'DECIMAL',
		);
}

$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

switch ( $show ) {
	case 'featured' :
	$query_args['meta_query'][] = array(
		'key'   => '_featured',
		'value' => 'yes'
		);
	break;
	case 'onsale' :
	$product_ids_on_sale    = wc_get_product_ids_on_sale();
	$product_ids_on_sale[]  = 0;
	$query_args['post__in'] = $product_ids_on_sale;
	break;
}

switch ( $orderby ) {
	case 'price' :
	$query_args['meta_key'] = '_price';
	$query_args['orderby']  = 'meta_value_num';
	break;
	case 'rand' :
	$query_args['orderby']  = 'rand';
	break;
	case 'sales' :
	$query_args['meta_key'] = 'total_sales';
	$query_args['orderby']  = 'meta_value_num';
	break;
	default :
	$query_args['orderby']  = 'date';
}


if ( $tag_id && $cat_id ) {
	$query_args['tax_query'] = array(
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
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_tag',
				'field' => 'id',
				'terms' => $tag_id,
				)
			);
	}

	if ( $cat_id ) {
		$query_args['product_cat'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $cat_id,
				)
			);
	}
}


$r  = new WP_Query( $query_args );
if ( $r->have_posts() ) :
	echo apply_filters( 'woocommerce_before_widget_product_list', '<div class="woocommerce"><h3>'.$title.'</h3><ul class="product_list_widget">' );
while ( $r->have_posts() ) : $r->the_post();
wc_get_template( 'content-widget-product.php', array( 'show_rating' => $show_rating ) );
endwhile;
echo apply_filters( 'woocommerce_after_widget_product_list', '</ul></div>' );
wp_reset_postdata();
endif;
