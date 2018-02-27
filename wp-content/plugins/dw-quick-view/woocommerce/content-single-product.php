<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" class="product" >

		<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

		<div class="summary">
			<?php do_action( 'woocommerce_single_product_summary' ); ?>
		</div>

</div>

