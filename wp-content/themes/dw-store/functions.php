<?php 
require get_template_directory() . '/inc/extra.php';

require get_template_directory() . '/inc/init.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
if ( class_exists( 'Woocommerce' ) ) {
require get_template_directory() . '/woocommerce/config.php';
}

