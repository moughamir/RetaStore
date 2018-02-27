<?php
add_theme_support('woocommerce');

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt', 15 );

add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter( 'woocommerce_output_related_products_args', 'dw_store_related_products_args' );
function dw_store_related_products_args( $args ) {
	$args = array(
		'posts_per_page' => 4,
		'columns' => 4,
		'orderby' => 'rand'
		);
	return $args;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'dw_store_woocommerce_output_upsells', 15 );
function dw_store_woocommerce_output_upsells() {
	woocommerce_upsell_display( 4, 4 );
}

add_filter( 'woocommerce_add_to_cart_fragments', 'dw_store_woocommerce_add_to_cart_fragment' );

function dw_store_woocommerce_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents btn btn-primary" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i> <span><?php echo sprintf (_n( '%d item in your cart', '%d items in your cart', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span> <strong><?php echo WC()->cart->cart_contents_count; ?></strong></a>
	<?php

	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}

if ( ! function_exists( 'dw_store_wrap_open' ) ) {
	function dw_store_wrap_open() {
	$column = 4;
	$data_column = 4;
	echo '<div class="woocommerce columns-'.$column.'" data-column="'.$data_column.'">';
	}

}


function dw_store_wrap_close() {
	echo '</div>';
}

add_action( 'woocommerce_before_shop_loop',	'dw_store_wrap_open', 50 );
add_action( 'woocommerce_after_shop_loop',	'dw_store_wrap_close', 50 );


if ( ! function_exists( 'dw_store_sidebar_position_class' ) ) {
	function dw_store_sidebar_position_class() {
		$class = 'col-sm-3';
		echo $class;
	}
}

if ( ! function_exists( 'dw_store_primary_position_class' ) ) {

	function dw_store_primary_position_class(){
		$class = 'col-sm-12';
		echo $class;
	}
}


if ( ! function_exists( 'dw_store_is_active_sidebar' ) ) {

	function dw_store_is_active_sidebar() {
		$active = false;
		return $active;
	}
}

if ( ! function_exists( 'dw_store_products_navigation' ) ) {
	function dw_store_products_navigation() {
		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'dw-store' ),
				'next_text' => __( '<i class="fa fa-caret-right"></i>', 'dw-store' ),
			)
		);
	}
}

function dw_store_add_category_fields() {
	?>
	<div class="form-field">
		<label for="listing_layout"><?php _e( 'Products Listing Layout', 'dw-store' ); ?></label>
		<select id="listing_layout" name="listing_layout" class="postform">
			<option id="list" value="list"><?php _e( 'List', 'dw-store' ); ?></option>
			<option id="grid" value="grid" ><?php _e( 'Grid', 'dw-store' ); ?></option>
		</select>
	</div>
	<div class="form-field grid_column" style='display:none'>
		<label for="grid_column"><?php _e( 'Grid Column', 'dw-store' ); ?></label>
		<select id="grid_column" name="grid_column" class="postform">
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		</select>
	</div>

	<div class="form-field">
		<label for="turning_sidebar"><?php _e( 'Turn On / Off Sidebar', 'dw-store' ); ?></label>
		<select id="turning_sidebar" name="turning_sidebar" class="postform">
			<option id="off" value="off"><?php _e( 'Off', 'dw-store' ); ?></option>
			<option id="on" value="on" ><?php _e( 'On', 'dw-store' ); ?></option>
		</select>
	</div>
	<div class="form-field sidebar_position" style='display:none'>
		<label for="sidebar_position"><?php _e( 'Select Sidebar Position', 'dw-store' ); ?></label>
		<select id="sidebar_position" name="sidebar_position" class="postform">
			<option value="left">Left</option>
			<option value="right">Right</option>
		</select>
		</select>
	</div>
	<?php

}

add_action( 'product_cat_add_form_fields', 'dw_store_add_category_fields' );

function dw_store_edit_category_fields( $term ) {
	$listing_layout = get_woocommerce_term_meta( $term->term_id, 'listing_layout', true );
	$grid_column = get_woocommerce_term_meta( $term->term_id, 'grid_column', true );
	$turning_sidebar = get_woocommerce_term_meta( $term->term_id, 'turning_sidebar', true );
	$sidebar_position = get_woocommerce_term_meta( $term->term_id, 'sidebar_position', true );
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="listing_layout"><?php _e( 'Products Listing Layout' ); ?></label></th>
		<td>
			<select  id="listing_layout" name="listing_layout" class="postform">
				<option id="grid" value="grid" <?php selected( 'grid', $listing_layout ); ?> >Grid</option>
				<option id="list" value="list" <?php selected( 'list', $listing_layout ); ?> >List</option>
			</select>

		</td>
	</tr>
	<tr class="form-field grid_column" style='display:none'>
		<th scope="row" valign="top"><label for="grid_column"><?php _e( 'Grid Column' ); ?></label></th>
		<td>
			<select  id="grid_column" name="grid_column" class="postform">
				<option value="2" <?php selected( '2', $grid_column ); ?> >2</option>
				<option value="3" <?php selected( '3', $grid_column ); ?> >3</option>
				<option value="4" <?php selected( '4', $grid_column ); ?> >4</option>
			</select>

		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="turning_sidebar"><?php _e( 'Turn On / Off Sidebar' ); ?></label></th>
		<td>
			<select  id="turning_sidebar" name="turning_sidebar" class="postform">
				<option id="on" value="on" <?php selected( 'on', $turning_sidebar ); ?> >On</option>
				<option id="off" value="off" <?php selected( 'off', $turning_sidebar ); ?> >Off</option>
			</select>

		</td>
	</tr>
	<tr class="form-field sidebar_position" style='display:none'>
		<th scope="row" valign="top"><label for="sidebar_position"><?php _e( 'Select Sidebar Position' ); ?></label></th>
		<td>
			<select  id="sidebar_position" name="sidebar_position" class="postform">
				<option value="left" <?php selected( 'left', $sidebar_position ); ?> >Left</option>
				<option value="right" <?php selected( 'right', $sidebar_position ); ?> >Right</option>
			</select>

		</td>
	</tr>
	<?php
}

add_action( 'product_cat_edit_form_fields', 'dw_store_edit_category_fields', 10 );

function dw_store_save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
	if ( isset( $_POST['listing_layout'] ) && 'product_cat' === $taxonomy ) {
		update_woocommerce_term_meta( $term_id, 'listing_layout', esc_attr( $_POST['listing_layout'] ) );
	}

	if ( isset( $_POST['grid_column'] ) && 'product_cat' === $taxonomy ) {
		update_woocommerce_term_meta( $term_id, 'grid_column', esc_attr( $_POST['grid_column'] ) );
	}

	if ( isset( $_POST['turning_sidebar'] ) && 'product_cat' === $taxonomy ) {
		update_woocommerce_term_meta( $term_id, 'turning_sidebar', esc_attr( $_POST['turning_sidebar'] ) );
	}

	if ( isset( $_POST['sidebar_position'] ) && 'product_cat' === $taxonomy ) {
		update_woocommerce_term_meta( $term_id, 'sidebar_position', esc_attr( $_POST['sidebar_position'] ) );
	}
}

add_action( 'created_term', 'dw_store_save_category_fields', 10, 3 );
add_action( 'edit_term', 'dw_store_save_category_fields', 10, 3 );
