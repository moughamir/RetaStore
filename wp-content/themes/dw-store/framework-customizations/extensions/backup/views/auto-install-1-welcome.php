<?php if (!defined('FW')) die('Forbidden');

/**
 * @var FW_Extension_Backup $backup
 */

$backup = fw()->extensions->get('backup');
$theme_name = fw()->theme->manifest->get_name();

?>
<div class="wrap">

	<div id="icon-tools" class="icon32"></div>

	<h2><?php strtr(__('{theme_name} WordPress Theme', 'fw'), array('{theme_name}' => esc_html($theme_name))) ?></h2>

	<h3><?php _e('Make you theme look exactly like our demo', 'fw') ?></h3>

	<p><?php echo sprintf('By importing the demo content, your theme will look like the one
		you see on %s our demo %s.
		This install is not necessary but will help you get the core pages,
		categories and meta setup correctly.
		This action will also let you understand how the theme works by
		allowing you to modify a content that is already there rather than
		creating it from scratch.', '<a href="http://demo.designwall.com/#dw-store">', '</a>' ) ?></p>
		<?php if ( class_exists( 'ZipArchive' ) ) : ?>
		<div class="error">
			<p>
				<strong><?php _e('Important', 'fw') ?>:</strong> <?php printf(__('The demo content %s will replace %s all of your content (i.e. all of your content %s will be deleted %s).', 'fw'), '<strong>', '</strong>', '<strong>', '</strong>') ?>
			</p>
		</div>

		<p>
			<a href="<?php echo esc_attr($backup->action()->url_backup_auto_install()) ?>&amp;auto-install-dir=techstore" onclick="return window.confirm('<?php _e('All your current content will be deleted and replaced with the demo content of the theme!', 'fw'); ?>');" class="button button-primary">
				<?php _e('Import Techstore', 'fw') ?>
			</a>
			|
			<a href="<?php echo esc_attr($backup->action()->url_backup_auto_install()) ?>&amp;auto-install-dir=marketstore" onclick="return window.confirm('<?php _e('All your current content will be deleted and replaced with the demo content of the theme!', 'fw'); ?>');" class="button button-primary">
				<?php _e('Import Marketstore', 'fw') ?>
			</a>
			|
			<a href="<?php echo esc_attr($backup->action()->url_backup_auto_install()) ?>&amp;auto-install-dir=pharmastore" onclick="return window.confirm('<?php _e('All your current content will be deleted and replaced with the demo content of the theme!', 'fw'); ?>');" class="button button-primary">
				<?php _e('Import Pharmastore', 'fw') ?>
			</a>
			|
			<a href="<?php echo esc_attr($backup->action()->url_backup_auto_install()) ?>&amp;auto-install-dir=kidstore" onclick="return window.confirm('<?php _e('All your current content will be deleted and replaced with the demo content of the theme!', 'fw'); ?>');" class="button button-primary">
				<?php _e('Import Kidstore', 'fw') ?>
			</a>
			|
			<a href="<?php echo esc_attr($backup->action()->url_backup_auto_install()) ?>&amp;auto-install-dir=giftstore" onclick="return window.confirm('<?php _e('All your current content will be deleted and replaced with the demo content of the theme!', 'fw'); ?>');" class="button button-primary">
				<?php _e('Import Giftstore', 'fw') ?>
			</a>
			|
			<a href="<?php echo esc_attr($backup->action()->url_backup_auto_install()) ?>&amp;auto-install-dir=fashionstore" onclick="return window.confirm('<?php _e('All your current content will be deleted and replaced with the demo content of the theme!', 'fw'); ?>');" class="button button-primary">
				<?php _e('Import Fashionstore', 'fw') ?>
			</a>
		</p>
	<?php else: ?>
	<div class="error">
		<p>
			<strong><?php _e( 'Important', 'fw' ) ?>
				:</strong> <?php printf( __( 'For importing demo content, you need to activate <a href="%s">zip extension</a>.', 'fw' ), 'http://php.net/manual/en/book.zip.php' ) ?>
			</p>
		</div>
	<?php endif; ?>
</div>
