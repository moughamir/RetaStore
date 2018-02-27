<?php
/*
* Template Name: Style Guides
*/

get_header(); ?>
<div class="container">
	<?php dw_store_breadcrumbs(); ?>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="page-content">
					<!-- Buttons -->
					<h3>Buttons</h3>
					<div class="row">
						<div class="col-md-3">
							<p><button type="button" class="btn btn-block">Normal</button></p>
						</div>
						<div class="col-md-3">
							<p><button type="button" class="btn btn-default btn-block">Default</button></p>
						</div>
						<div class="col-md-3">
							<p><button type="button" class="btn btn-primary btn-block">Primary</button></p>
						</div>
						<div class="col-md-3">
							<p><button type="button" class="btn btn-success btn-block">Success</button></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<p><button type="button" class="btn btn-info btn-block">Info</button></p>
						</div>
						<div class="col-md-3">
							<p><button type="button" class="btn btn-warning btn-block">Warning</button></p>
						</div>
						<div class="col-md-3">
							<p><button type="button" class="btn btn-danger btn-block">Danger</button></p>
						</div>
						<div class="col-md-3">
							<p><button type="button" class="btn btn-link btn-block">Link</button></p>
						</div>
					</div>

					<!-- Button Groups -->
					<h3>Button Groups</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-4">
									<div class="btn-group">
										<button type="button" class="btn"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
								<div class="col-md-4">
									<div class="btn-group">
										<button type="button" class="btn btn-default"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-default"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-default"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
								<div class="col-md-4">
									<div class="btn-group">
										<button type="button" class="btn btn-primary"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-primary"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-primary"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="btn-group">
										<button type="button" class="btn btn-success"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-success"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-success"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
								<div class="col-md-4">
									<div class="btn-group">
										<button type="button" class="btn btn-info"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-info"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-info"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
								<div class="col-md-4">
									<div class="btn-group">
										<button type="button" class="btn btn-warning"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-warning"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-warning"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="btn-group">
										<button type="button" class="btn btn-danger"><i class="fa fa-align-left"></i></button>
										<button type="button" class="btn btn-danger"><i class="fa fa-align-center"></i></button>
										<button type="button" class="btn btn-danger"><i class="fa fa-align-right"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-2">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn"><i class="fa fa-home"></i></button>
										<button type="button" class="btn btn"><i class="fa fa-user"></i></button>
										<button type="button" class="btn btn"><i class="fa fa-comment"></i></button>
										<button type="button" class="btn btn"><i class="fa fa-cog"></i></button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-default"><i class="fa fa-home"></i></button>
										<button type="button" class="btn btn-default"><i class="fa fa-user"></i></button>
										<button type="button" class="btn btn-default"><i class="fa fa-comment"></i></button>
										<button type="button" class="btn btn-default"><i class="fa fa-cog"></i></button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-primary"><i class="fa fa-home"></i></button>
										<button type="button" class="btn btn-primary"><i class="fa fa-user"></i></button>
										<button type="button" class="btn btn-primary"><i class="fa fa-comment"></i></button>
										<button type="button" class="btn btn-primary"><i class="fa fa-cog"></i></button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-success"><i class="fa fa-home"></i></button>
										<button type="button" class="btn btn-success"><i class="fa fa-user"></i></button>
										<button type="button" class="btn btn-success"><i class="fa fa-comment"></i></button>
										<button type="button" class="btn btn-success"><i class="fa fa-cog"></i></button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-info"><i class="fa fa-home"></i></button>
										<button type="button" class="btn btn-info"><i class="fa fa-user"></i></button>
										<button type="button" class="btn btn-info"><i class="fa fa-comment"></i></button>
										<button type="button" class="btn btn-info"><i class="fa fa-cog"></i></button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="btn-group-vertical">
										<button type="button" class="btn btn-danger"><i class="fa fa-home"></i></button>
										<button type="button" class="btn btn-danger"><i class="fa fa-user"></i></button>
										<button type="button" class="btn btn-danger"><i class="fa fa-comment"></i></button>
										<button type="button" class="btn btn-danger"><i class="fa fa-cog"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Button Dropdowns -->
					<h3>Button Dropdowns</h3>
					<div class="row">
	          <div class="col-md-12">
	            <div class="btn-group">
	              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Normal <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>

	            <div class="btn-group">
	              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>

	            <div class="btn-group">
	              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Primary <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>

	            <div class="btn-group">
	              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Success <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>

	            <div class="btn-group">
	              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Info <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>

	            <div class="btn-group">
	              <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Warning <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>

	            <div class="btn-group">
	              <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Danger <span class="caret"></span></button>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Separated link</a></li>
	              </ul>
	            </div>
	          </div>
	        </div>
				</div>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php get_footer(); ?>
