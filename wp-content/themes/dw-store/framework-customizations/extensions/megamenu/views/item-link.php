<?php if (!defined('FW')) die('Forbidden');
{
	$icon_html = '';

	if ( fw()->extensions->get('megamenu')->show_icon() && ( $icon = fw_ext_mega_menu_get_meta( $item, 'icon' ) ) ) {
		$icon_html = '<i class="'. $icon .'"></i> ';
	}
}

echo $args->before;
echo fw_html_tag('a', $attributes, $args->link_before . $icon_html . $title . $args->link_after);
echo $args->after;
