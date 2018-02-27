	</div>

	<footer id="colophon" class="<?php dw_store_footer_class(); ?>" role="contentinfo">
		<div class="container">
			<div class="footer-inner">
				<?php get_sidebar( 'footer' ); ?>
				<div class="row">
					<div class="col-md-6">
						<div class="site-info">
							<?php dw_store_footer_copyright(); ?>
						</div>
						<?php dw_store_social_links(); ?>
					</div>
					<div class="col-md-6 text-right">
						<?php dw_store_footer_logo(); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
