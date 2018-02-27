<?php
if ( ! function_exists( 'dw_store_entry_meta' ) ) :
function dw_store_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '<i class="fa fa-calendar"></i> %s', 'post date', 'dw-store' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '<i class="fa fa-user"></i> %s', 'post author', 'dw-store' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	$categories_list = get_the_category_list( __( ', ', 'dw-store' ) );
	if ( $categories_list && dw_store_categorized_blog() ) {
		printf( '<span class="cat-links">' . __( '<i class="fa fa-folder"></i> %1$s', 'dw-store' ) . '</span>', $categories_list );
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		echo '<i class="fa fa-comments"></i>';
		comments_popup_link( __( '0 Comments', 'dw-store' ), __( '1 Comment', 'dw-store' ), __( '% Comments', 'dw-store' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'dw_store_entry_footer' ) ) :
function dw_store_entry_footer() {
	if ( 'post' == get_post_type() ) {
		echo '<footer class="entry-footer">';
		$tags_list = get_the_tag_list( '', __( ', ', 'dw-store' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tags  %1$s', 'dw-store' ) . '</span>', $tags_list );
		}
		echo '</footer>';
	}
}
endif;

if ( ! function_exists( 'dw_store_posts_navigation' ) ) :
function dw_store_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size' => 4,
				'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'dw-store' ),
				'next_text' => __( '<i class="fa fa-caret-right"></i>', 'dw-store' ),
			)
		);
}
endif;

function dw_store_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'dw_store_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'dw_store_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}

function dw_store_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'dw_store_categories' );
}
add_action( 'edit_category', 'dw_store_category_transient_flusher' );
add_action( 'save_post',     'dw_store_category_transient_flusher' );

if ( ! function_exists( 'dw_store_breadcrumbs' ) ) :
function dw_store_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="breadcrumbs">', '</div>' );
	} else if ( function_exists('fw_ext_breadcrumbs') ) {
		fw_ext_breadcrumbs( __( '<span class="sep"><i class="fa fa-caret-right"></i></span>', 'dw-store' ) );
	}
}
endif;

if ( ! function_exists( 'dw_store_primary_column_class' ) ) :
function dw_store_primary_column_class() {
	echo 'col-sm-9';
}
endif;

if ( ! function_exists( 'dw_store_secondary_column_class' ) ) :
function dw_store_secondary_column_class() {
	echo 'col-sm-3';
}
endif;

if ( ! function_exists( 'dw_store_print_typography_css' ) ) :
function dw_store_print_typography_css( $selector, $option ) {
	$css = $selector . ' { ';
	$typography_option = dw_store_get_theme_option( $option );
	$current_style = $typography_option['style'];
	if ( $current_style === 'regular' ) {
		$current_style = '400';
	}
	if ( $current_style == 'italic' ) {
		$current_style = '400italic';
	}
	$css .= 'font-weight: ' . intval( $current_style ) . ';';
	$css .= ( strpos( $current_style, 'italic' ) ) ? 'font-style: italic;' : '';
	if ( isset( $typography_option['size'] ) ) { $css .= 'font-size: ' . $typography_option['size'] . 'px;'; }
	if ( isset( $typography_option['family'] ) ) { $css .= 'font-family: ' . $typography_option['family'] . ';'; }
	if ( isset( $typography_option['color'] ) ) { $css .= 'color: ' . $typography_option['color'] . ';'; }

	$css .= ' } ';
	return $css;
}
endif;

if ( ! function_exists( 'dw_store_topbar_class' ) ) :
function dw_store_topbar_class() {
	$classes = 'site-topbar';
	$topbar_style = dw_store_get_theme_option( 'topbar_style' );
	if ( $topbar_style === 'light' ) {
		$classes .= ' topbar-default';
	} else {
		$classes .= ' topbar-inverse';
	}
	echo $classes;
}
endif;

if ( ! function_exists( 'dw_store_navbar_class' ) ) :
function dw_store_navbar_class() {
	$classes = 'site-navbar navbar navbar-static-top';
	$navbar_style = dw_store_get_theme_option( 'navbar_style' );
	if ( $navbar_style === 'light' ) {
		$classes .= ' navbar-default';
	} else {
		$classes .= ' navbar-inverse';
	}
	echo $classes;
}
endif;

if ( ! function_exists( 'dw_store_footer_class' ) ) :
function dw_store_footer_class() {
	$classes = 'site-footer';
	$footer_style = dw_store_get_theme_option( 'footer_style' );
	if ( $footer_style === 'light' ) {
		$classes .= ' footer-default';
	} else {
		$classes .= ' footer-inverse';
	}
	echo $classes;
}
endif;

if ( ! function_exists( 'dw_store_social_links' ) ) :
function dw_store_social_links() {
	$social = dw_store_get_theme_option( 'social-setting' );
	if ( ! empty( $social ) ) : ?>
		<ul class="social-links list-inline">
			<?php foreach ( $social as $item ) { ?>
			<li>
				<a href="<?php echo esc_attr( $item['social_link'] );?>"><i class="<?php echo esc_attr( $item['social']); ?>"></i></a>
			</li>
			<?php } ?>
		</ul>
	<?php endif; ?>
<?php
}
endif;

if ( ! function_exists( 'dw_store_footer_logo' ) ) :
function dw_store_footer_logo() {
	$footer_logo = dw_store_get_theme_option( 'footer_logo' );
	if ( ! empty( $footer_logo ) ) : ?>
		<img src="<?php echo esc_url( $footer_logo['url'] ); ?>">
	<?php endif; ?>
<?php
}
endif;

if ( ! function_exists( 'dw_store_footer_copyright' ) ) :
function dw_store_footer_copyright() {
	$footer_copyright = dw_store_get_theme_option( 'footer_copyright' );
	if ( $footer_copyright ) {
		echo $footer_copyright;
	} else {
		echo 'Copyright © 2015.	Theme: DW Store by <a href="http://www.designwall.com">DesignWall</a>.
Proudly powered by <a href="http://wordpress.org">WordPress</a>';
	}
}
endif;

if ( ! function_exists( 'dw_store_favicon' ) ) :
function dw_store_favicon() {
	if ( dw_store_get_theme_option( 'favicon/url' ) ) {
		echo '<link type="image/x-icon" href="' . esc_attr( dw_store_get_theme_option( 'favicon/url' ) ) . '" rel="shortcut icon">';
	}
}
endif;
add_action( 'wp_head', 'dw_store_favicon' );


if ( ! function_exists( 'dw_store_cat_filter' ) ) {

	function dw_store_cat_filter($list_type) {
		if ( isset( $_COOKIE['shop_layout'] ) ){
			$list_type = htmlentities( $_COOKIE['shop_layout'] );
		}
		return $list_type;
	}
	add_filter( 'layout_display_filter', 'dw_store_cat_filter' );
}
