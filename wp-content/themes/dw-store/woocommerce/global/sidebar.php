<?php

/**
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.3
 */

if ( ! is_active_sidebar( 'shop-sidebar' ) || ! dw_store_is_active_sidebar() ) {
	return;
}
?>
			<div class="<?php dw_store_sidebar_position_class(); ?>">
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'shop-sidebar' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
