<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header">
		<?php do_action( 'dw_store_before_header' ); ?>
		<nav id="topbar" class="<?php dw_store_topbar_class(); ?>">
			<div class="container">
				<div class="row">
					<div class="col-sm-6"><div class="site-description"><?php bloginfo( 'description' ); ?></div></div>
					<div class="col-sm-6 hidden-xs">
						<ul class="topbar-menu list-inline pull-right">
							<li class="search-wrap pull-right">
								<a href="#" class="toggle-search"><i class="fa fa-search"></i></a>
								<?php echo get_search_form(); ?>
							</li>
							<?php if ( has_nav_menu( 'secondary' ) ) : ?>
							<li class="dropdown hidden-sm">
								<a href="#" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
								<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'dropdown-menu dropdown-menu-right' ) ); ?>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<nav id="navbar" class="<?php dw_store_navbar_class(); ?>">
			<div class="container">
				<div class="navbar-header">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<button class="navbar-toggle primary-toggle" data-toggle="collapse" data-target=".main-navigation">
							<span class="sr-only"><?php _e( 'Toggle primary navigation', 'dw-store' ); ?></span>
							<i class="fa fa-bars"></i>
						</button>
					<?php endif; ?>
					<?php if ( has_nav_menu( 'secondary' ) ) : ?>
						<button class="navbar-toggle secondary-toggle" data-toggle="collapse" data-target=".secondary-navigation">
							<span class="sr-only"><?php _e( 'Toggle secondary navigation', 'dw-store' ); ?></span>
							<i class="fa fa-ellipsis-v"></i>
						</button>
					<?php endif; ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand">
						<?php $site_logo = dw_store_get_theme_option( 'logo/url' ); ?>
						<?php if( $site_logo ) : ?>
							<img src="<?php echo esc_url( $site_logo ); ?>" title="<?php bloginfo('name'); ?>">
						<?php else : ?>
							<?php bloginfo('name'); ?>
						<?php endif; ?>
					</a>
				</div>

				<nav id="site-navigation" class="collapse navbar-collapse main-navigation navbar-right" role="navigation">
					<?php if ( has_nav_menu( 'primary' ) ) : ?><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav navbar-nav' ) ); ?><?php endif; ?>
				</nav>
				<nav id="secondary-navigation" class="collapse navbar-collapse secondary-navigation" role="navigation">
					<?php if ( has_nav_menu( 'secondary' ) ) : ?><?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav navbar-nav visible-xs visible-sm' ) ); ?><?php endif; ?>
				</nav>
			</div>
		</nav>
		<?php do_action( 'dw_store_after_header' ); ?>
	</header>
	<div id="content" class="site-content">
