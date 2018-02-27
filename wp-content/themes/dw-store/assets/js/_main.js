(function($) {
	"use strict";

	var $container = $('.masonry-container');

	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.masonry-item',
			//columnWidth : 310,
			isAnimated: true
		});
	});

	$container.infinitescroll({
		navSelector  : '.load-more',
		nextSelector : '.load-more a',
		itemSelector : '.masonry-item',
		loading: {
			finishedMsg: 'No more pages to load.',
				img: dw_store_script.loading_src
			}
		},
		// trigger Masonry as a callback
		function( newElements ) {
			// hide new items while they are loading
			var $newElems = $( newElements ).css({ opacity: 0 });
			// ensure that images load before adding to masonry layout
			$newElems.imagesLoaded(function(){
				// show elems now they're ready
				$newElems.animate({ opacity: 1 });
				$container.masonry( 'appended', $newElems, true );
			});
		}
	);


	var content_select = 'ul.products';
	var infinite_scroll = {
		loading: {
			img: dw_store_script.loading_src,
			msgText: 'Loading the next set of products...',
			finishedMsg: 'All products loaded.'

		},
		"nextSelector":".load-more a",
		"navSelector":".load-more",
		"itemSelector":"li.product",
		"contentSelector": content_select,
		"extraScrollPx": 100,
     "bufferPx"     : 1,
     "behavior"     : "twitter"
	};

  $( infinite_scroll.contentSelector ).infinitescroll(infinite_scroll);



	$('.dw-mini-cart .dropdown').hover(function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(500);
		$(this).find('.cart-contents').addClass('open');
	}, function() {
		$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(500);
		$(this).find('.cart-contents').removeClass('open');
	});

	$('.open-search').on('click', function() {
		$('.search-modal').removeClass('hide');
	});

	$('.woocommerce-page .toggle-filter').on('click', function() {
		$('.woocommerce-page .filter-inner').toggleClass('open');
	});

	function getMaxChildWidth() {
		var div_max = Math.max.apply(Math, $('<div>').map(function(){ return $(this).width(); }).get());
		return div_max;
	}

	$('.main-navigation .navbar-nav > li').mouseover(function(event) {
		var menu_width =  $(this).find('.mega-menu').width();
		var max_width = $(window).width();
		var fixed = 20;
		if( $('body').hasClass('layout-fixed-width') ) {
			fixed = parseInt( ( max_width - $('#page').width() ) / 2 );
		}


		if( menu_width ) {

			var offset = $(this).offset().left;
			if( getMaxChildWidth() > $(window).width() ) {
				max_width =  getMaxChildWidth();
			}
			if( menu_width + offset + fixed > max_width ) {
				$(this).find('.mega-menu').css( 'left', -( menu_width + offset - max_width ) - fixed );
			}else {
				$(this).find('.mega-menu').css( 'left', 0);
			}
		}

	});

	$( document ).ready( function() {
		var max_width = $(window).width();
		var fixed = 20;
		if( $('body').hasClass('layout-fixed-width') ) {
			fixed = parseInt( ( max_width - $('#page').width() ) / 2 );
		}
		var elem = $('.main-navigation .navbar-nav > li');
		elem.each(function(index, el) {
			var menu_width = $(this).find('.mega-menu').width();
			if( menu_width ) {
				var offset = $(this).offset().left;
				if( getMaxChildWidth() > $(window).width() ) {
					max_width =  getMaxChildWidth();
				}
				if( menu_width + offset + fixed > max_width ) {
					$(this).find('.mega-menu').css( 'left', -( menu_width + offset - max_width ) - fixed );
				}
			}
		});

	});

	$( window ).resize(function() {
		var max_width = $(window).width();
		var fixed = 20;
		if( $('body').hasClass('layout-fixed-width') ) {
			fixed = parseInt( ( max_width - $('#page').width() ) / 2 );
		}
		var elem = $('.main-navigation .navbar-nav > li');
		elem.each(function(index, el) {
			var menu_width = $(this).find('.mega-menu').width();
			if( menu_width ) {
				var offset = $(this).offset().left;
				if( getMaxChildWidth() > $(window).width() ) {
					max_width =  getMaxChildWidth();
				}

				if( menu_width + offset + fixed > max_width ) {
					$(this).find('.mega-menu').css( 'left', -( menu_width + offset - max_width ) - fixed );
				}

			}
		});
	});


		// Set cookie
	function setCookie(c_name,value,exdays) {
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}

	// Get cookie
	function getCookie(c_name) {
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++) {
			x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			x=x.replace(/^\s+|\s+$/g,"");
			if (x === c_name) {
				return unescape(y);
			}
		}
	}

	$('.layout-select a').click(function(e){
		e.preventDefault();
		if( $(this).hasClass('active') ) { return; }
		var layout = $(this).data('display');
		setCookie( 'shop_layout', layout );
		$('#primary .woocommerce').fadeOut(function(){
			var column = $(this).data('column');
			if ( 'list' === layout ) {
				column = 1;
			}

			$('#primary .woocommerce').attr('class','woocommerce').addClass('columns-'+column).fadeIn();
		});

		$('.layout-select a').removeClass('active');
		$(this).addClass('active');
	});


	$('#myCarousel').carousel({
		interval: 4000
	});

	// handles the carousel thumbnails
	$('[id^=carousel-selector-]').click( function(){
		var id_selector = $(this).attr("id");
		var id = id_selector.substr(id_selector.length -1);
		id = parseInt(id);
		$('#myCarousel').carousel(id);
		$('[id^=carousel-selector-]').removeClass('selected');
		$(this).addClass('selected');
	});

	// when the carousel slides, auto update
	$('#myCarousel').on('slid', function (e) {
		var id = $('.item.active').data('slide-number');
		id = parseInt(id);
		$('[id^=carousel-selector-]').removeClass('selected');
		$('[id=carousel-selector-'+id+']').addClass('selected');
	});


	})(jQuery);
