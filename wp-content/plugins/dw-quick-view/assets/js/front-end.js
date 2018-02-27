/**
 * frontend.js
 *
 * @author Your Inspiration Themes
 * @package dw WooCommerce Quick View
 * @version 1.0.0
 */

 jQuery(document).ready(function($){
 	"use strict";

 	var qv_modal    = $(document).find( '#dwqv-modal' ),
 	qv_overlay  = qv_modal.find( '.dwqv-overlay'),
 	qv_content  = qv_modal.find( '#dwqv-content' ),
 	qv_close    = qv_modal.find( '#dwqv-close' );


    /*==================
     *MAIN BUTTON OPEN
     ==================*/

     $.fn.dw_quick_view = function() {

     	var button  = $(document).find( '.dwqv-button' );

        // remove prev click event
        button.off( 'click' );

        button.on( 'click', function(e){

        	e.preventDefault();

        	var t           = $(this),
        	product_id  = t.data( 'product_id' ),
        	is_blocked  = false;

        	$.ajax({
        		url: dwqv_script.ajax_url,
        		type: 'GET',
        		dataType: 'html',
        		data: {
        			action : 'dw-product-quickview',
        			product_id: product_id
        		},
        		async: false
        	})
        	.done(function( resp ) {
        		if( resp ) {

        			qv_content.html(resp);
        			var form_variation = qv_content.find( '.variations_form' );

        			form_variation.wc_variation_form();

        			if( typeof $.fn.dw_wccl !== 'undefined' ) {
        				form_variation.dw_wccl();
        			}


            if( ! qv_modal.hasClass( 'open' ) ) {
                qv_modal.addClass('open')
    
            	if( is_blocked ) {
                    t.unblock();
                }
            		
            }

            // stop loader
            $(document).trigger( 'qv_loader_stop' );
          }
        });
		});
	};

    /*================
     * MAIN AJAX CALL
     ================*/

     var ajax_call = function( t, product_id, is_blocked ) {

     	$.post( dwqv_script.ajax_url, { action: 'dw_product_quickview', product_id: product_id }, function( data ) {
     		qv_content.html( data );

            // Variation Form
            var form_variation = qv_content.find( '.variations_form' );

            form_variation.wc_variation_form();

            if( typeof $.fn.dw_wccl !== 'undefined' ) {
            	form_variation.dw_wccl();
            }

            if( ! qv_modal.hasClass( 'open' ) ) {
            	qv_modal.addClass('open');
            	if( is_blocked )
            		t.unblock();
            }

            // stop loader
            $(document).trigger( 'qv_loader_stop' );

          });
};

    /*===================
     * CLOSE QUICK VIEW
     ===================*/

     var close_modal_qv = function() {

        // Close box by click overlay
        qv_overlay.on( 'click', function(e){
        	close_qv();
        });
        // Close box with esc key
        $(document).keyup(function(e){
        	if( e.keyCode === 27 )
        		close_qv();
        });
        // Close box by click close button
        qv_close.on( 'click', function(e) {
        	e.preventDefault();
        	close_qv();
        });

        var close_qv = function() {
        	qv_modal.removeClass('open');
        	qv_content.html('');

        }
      };

      close_modal_qv();

    // START
    $.fn.dw_quick_view();

    $( document ).on( 'dw_infs_adding_elem', function(){
        // RESTART
        $.fn.dw_quick_view();
      });

    $('body').delegate('#dwqv-content .images .thumbnails .zoom', 'click', function(event){
    	$('.images a').removeClass('active');
    	event.preventDefault();
    	var t = $(this);
    	t.addClass('active');
    	var parent = t.closest('.images');
    	var image = t.attr('href');

    	parent.find('.woocommerce-main-image').attr('href', image).find('img').attr('src', image );
    });

});