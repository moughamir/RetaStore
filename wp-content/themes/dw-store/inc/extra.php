<?php
// Add Minicart
add_action( 'dw_store_after_header', 'dw_store_mini_cart' );
function dw_store_mini_cart() {
	if ( function_exists( 'woocommerce_mini_cart' ) ) : ?>
	<div class="dw-mini-cart-wrap">
		<div class="container">
			<div class="dw-mini-cart">
				<div class="dropdown">
					<a class="cart-contents btn btn-primary" href="<?php echo WC()->cart->get_cart_url(); ?>" ><i class="fa fa-shopping-cart"></i> <span><?php echo sprintf (_n( '%d item in your cart', '%d items in your cart', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span> <strong><?php echo WC()->cart->cart_contents_count; ?></strong></a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="widget_shopping_cart_content">
							<?php woocommerce_mini_cart(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif;
}

// Add Quick View Plugin
function dw_store_register_required_plugins() {
	$plugins = array(
		array(
			'name'        => 'Unyson',
			'slug'        => 'unyson',
			'required'    => true,
			'source'      => get_template_directory().'/plugin/unyson.zip'
			),
		array(
			'name'        => 'WooCommerce',
			'slug'        => 'woocommerce',
			'required'    => true
			),
		array(
			'name'        => 'DW Quick View',
			'slug'        => 'dw-quick-view',
			'required'    => false,
			'source'      => get_template_directory().'/plugin/dw-quick-view.zip'
			)
		);

	$config = array(
		'id'           => 'dw-store',
		'menu'         => 'dw-store-install-plugins'
		);
	tgmpa( $plugins, $config );
}

// Add Shop Filter
add_action( 'woocommerce_before_main_content', 'dw_store_woocommerce_shop_filter', 30 );
function dw_store_woocommerce_shop_filter() {
	if ( ! is_single() ) {
		get_template_part( 'sidebar', 'shop-filter' );
	}
}

function dw_store_grid_list_toggle() {
	if ( isset( get_queried_object()->term_id ) ) {
		$listing_layout = get_woocommerce_term_meta( get_queried_object()->term_id, 'listing_layout', true );
		$layout = $listing_layout ? $listing_layout : 'grid';

	} else {
		$laytout_option = dw_store_get_theme_option( 'products_listing_layout' );
		$layout = $laytout_option['products_listing_layout'] ? $laytout_option['products_listing_layout'] : 'grid';
	}

	?>
	<div class="layout-select pull-right">
		<a data-display="grid" class="display-grid <?php dw_store_active( apply_filters( 'layout_display_filter', $layout ), 'grid' ); ?>" href="#"  title="<?php echo __('Grid View', 'dw-store') ?>"><i class="fa fa-th"></i></a>
		<a data-display="list" class="display-list <?php dw_store_active( apply_filters( 'layout_display_filter', $layout ), 'list' ); ?>" href="#"  title="<?php echo __('List View', 'dw-store') ?>"><i class="fa fa-th-list"></i></a>
	</div>
	<?php
}

add_action( 'woocommerce_before_shop_loop', 'dw_store_grid_list_toggle', 40 );


function dw_store_add_zoom_product() {
	?>
	<script>
	function isMobile() {
		if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
			return true;
		} else {
			return false;
		}
	}
	if ( !isMobile() ) {
		jQuery('#zoom_elevate').elevateZoom({ gallery:'zoom-gallery',  galleryActiveClass: "active", lensSize: 100 });
	//pass the images to Fancybox
	jQuery('#zoom_elevate').bind('click', function(e) {
		var ez = jQuery('#zoom_elevate').data('elevateZoom');
		jQuery.fancybox(ez.getGalleryList());
		return false;
	});
} else {

	jQuery('body').delegate('.images .thumbnails .zoom', 'click', function(event){
		event.preventDefault();
		var t = jQuery(this);
		var parent = t.closest('.images');
		var image = t.attr('href');

		parent.find('.woocommerce-main-image').attr('href', image).find('img').attr('src', image );
	});
}
</script>
<?php
}

add_action( 'wp_footer', 'dw_store_add_zoom_product' );

function dw_store_loop_columns() {
	$product_layouts = dw_store_get_theme_option('products_listing_layout');
	if ( isset( $_COOKIE['shop_layout'] ) ){
		$layout = htmlentities( $_COOKIE['shop_layout'] );
		$column = $product_layouts['grid']['columns'] ? $product_layouts['grid']['columns'] : 4;
	} else
	if ( isset( get_queried_object()->term_id ) ) {
		$layout = get_woocommerce_term_meta( get_queried_object()->term_id, 'listing_layout', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'listing_layout', true ) : $product_layouts['products_listing_layout'];
		$column = get_woocommerce_term_meta( get_queried_object()->term_id, 'grid_column', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'grid_column', true ) : $product_layouts['grid']['columns'];
	} else {
		$layout = $product_layouts['products_listing_layout'] ? $product_layouts['products_listing_layout']: 'grid';
		$column = $product_layouts['grid']['columns'] ? $product_layouts['grid']['columns'] : 4;
	}
	if ( 'list' == $layout ) {
		$column = 1;
	}

	return $column;
}


function dw_store_loop_columns_filter() {
	$product_layouts = dw_store_get_theme_option('products_listing_layout');
	if ( isset( get_queried_object()->term_id ) ) {
		$layout = get_woocommerce_term_meta( get_queried_object()->term_id, 'listing_layout', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'listing_layout', true ) : $product_layouts['products_listing_layout'];
		$column = get_woocommerce_term_meta( get_queried_object()->term_id, 'grid_column', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'grid_column', true ) : $product_layouts['grid']['columns'];
	} else {
		$layout = $product_layouts['products_listing_layout'] ? $product_layouts['products_listing_layout']: 'grid';
		$column = $product_layouts['grid']['columns'] ? $product_layouts['grid']['columns'] : 4;
	}

	return $column;
}
add_filter( 'loop_shop_columns', 'dw_store_loop_columns_filter' );


function dw_store_wrap_open() {
	$column = dw_store_loop_columns();
	if ( 1 == $column ) {
		$data_column = dw_store_loop_columns_filter();
	} else {
		$data_column = $column;
	}
	apply_filters( 'loop_shop_columns', $data_column );
	echo '<div class="woocommerce columns-'.$column.'" data-column="'.$data_column.'">';
}


add_action( 'woocommerce_before_shop_loop',	'dw_store_wrap_open', 50 );
add_action( 'woocommerce_after_shop_loop',	'dw_store_wrap_close', 50 );


function dw_store_sidebar_position_class() {
	$turning_sidebar = dw_store_get_theme_option( 'turning_sidebar' );
	$turning_sidebar_var = $turning_sidebar['turning_sidebar'];
	$sidebar_position = $turning_sidebar['on']['sidebar_position'];
	if ( isset( get_queried_object()->term_id ) ) {
		$turning_sidebar_var = get_woocommerce_term_meta( get_queried_object()->term_id, 'turning_sidebar', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'turning_sidebar', true ) : $turning_sidebar['turning_sidebar'];
		$sidebar_position = get_woocommerce_term_meta( get_queried_object()->term_id, 'sidebar_position', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'sidebar_position', true ) : $turning_sidebar['on']['sidebar_position'];
	}

	if ( 'on' == $turning_sidebar_var && 'left' == $sidebar_position ) {
		$class = 'col-sm-3 col-sm-pull-9';
	} else {
		$class = 'col-sm-3';
	}

	echo $class;
}


function dw_store_primary_position_class(){
	$turning_sidebar = dw_store_get_theme_option( 'turning_sidebar' );
	$turning_sidebar_var = $turning_sidebar['turning_sidebar'];
	$sidebar_position = $turning_sidebar['on']['sidebar_position'];
	if ( isset( get_queried_object()->term_id ) ) {
		$turning_sidebar_var = get_woocommerce_term_meta( get_queried_object()->term_id, 'turning_sidebar', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'turning_sidebar', true ) : $turning_sidebar['turning_sidebar'];
		$sidebar_position = get_woocommerce_term_meta( get_queried_object()->term_id, 'sidebar_position', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'sidebar_position', true ) : $turning_sidebar['on']['sidebar_position'];
	}
	if ( 'on' == $turning_sidebar_var ) {
		if ( 'left' == $sidebar_position ) {
			$class = 'col-sm-9 col-sm-push-3';
		}	else {
			$class = 'col-sm-9';
		}

	} else {
		$class = 'col-sm-12';
	}
	echo $class;
}


function dw_store_is_active_sidebar() {
	$turning_sidebar = dw_store_get_theme_option( 'turning_sidebar' );
	$turning_sidebar_var = $turning_sidebar['turning_sidebar'];
	if ( isset( get_queried_object()->term_id ) ) {
		$turning_sidebar_var = get_woocommerce_term_meta( get_queried_object()->term_id, 'turning_sidebar', true ) ? get_woocommerce_term_meta( get_queried_object()->term_id, 'turning_sidebar', true ) : $turning_sidebar['turning_sidebar'];
	}

	if ( 'on' == $turning_sidebar_var ) {
		$active = true;
	} else {
		$active = false;
	}
	return $active;
}


function dw_store_styling_body_classes( $classes ) {
	$site_layout = dw_store_get_theme_option( 'site_layout' );
	if ( $site_layout === 'fixed-width' ) {
		$classes[] = 'layout-fixed-width';
	} else {
		$classes[] = 'layout-full-width';
	}
	return $classes;
}

add_filter( 'body_class', 'dw_store_styling_body_classes' );

function dw_store_add_custom_css() {
	if ( dw_store_get_theme_option( 'custom_css' ) ) {
		$custom_css = dw_store_get_theme_option( 'custom_css' );
		echo '<style type="text/css">' . esc_html( $custom_css ) . '</style>';
	}
}

add_action( 'wp_head', 'dw_store_add_custom_css' );


function dw_store_posts_navigation() {
	if ( dw_store_get_theme_option( 'posts_navigation' ) == 'paging' ) {
		the_posts_pagination(
			array(
				'mid_size' => 4,
				'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'dw-store' ),
				'next_text' => __( '<i class="fa fa-caret-right"></i>', 'dw-store' ),
			)
		);
	} else if ( dw_store_get_theme_option( 'posts_navigation' ) == 'next_previous' ){
		the_posts_navigation(
			array(
				'prev_text' => __( 'Prev', 'dw-store' ),
				'next_text' => __( 'Next', 'dw-store' ),
			)
		);
	} else {
		global $wp_query;
		?>
		<div class="load-more hide">
			<?php next_posts_link( __( 'Load more products', 'dw-store' ), $wp_query->max_num_pages ); ?>
		</div>
		<?php
	}
}


function dw_store_products_navigation() {
	if ( dw_store_get_theme_option( 'products_navigation' ) == 'paging' ) {
		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'dw-store' ),
				'next_text' => __( '<i class="fa fa-caret-right"></i>', 'dw-store' ),
			)
		);
	} else if( dw_store_get_theme_option( 'products_navigation' ) == 'next_previous' ) {
		the_posts_navigation(
			array(
				'prev_text' => __( 'Prev', 'dw-store' ),
				'next_text' => __( 'Next', 'dw-store' ),
			)
		);
	} else {
		?>
		<div class="load-more">
			<?php next_posts_link( __( 'Load more products', 'dw-store' ), 0 ); ?>
		</div>
		<?php
	}
}

