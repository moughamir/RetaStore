<?php
/**
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.3
 */
?>

<?php if ( ! is_single() ) get_template_part( 'sidebar', 'shop-header' ); ?>
<div class="woocommerce-wrapper">
	<div class="container">
		<?php dw_store_breadcrumbs(); ?>
		<div class="row">
			<div class="<?php dw_store_primary_position_class(); ?>">
				<div id="primary" class="content-area">
