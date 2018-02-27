<?php
if ( ! is_active_sidebar( 'shop-filter' ) ) {
	return;
}
?>
<div class="shop-filter">
	<a href="javascript:void(0);" class="toggle-filter"><?php _e( 'Filter <i class="fa fa-filter"></i>' ); ?></a>
	<div class="filter-inner">
		<a href="javascript:void(0);" class="toggle-filter"><?php _e( 'Filter <i class="fa fa-filter"></i>' ); ?><i class="fa fa-times"></i></a>
		<?php dynamic_sidebar( 'shop-filter' ); ?>
	</div>
</div>
