jQuery(document).ready(function($) {
	var update_grid = function () {
  	if ($('#grid').is(":selected")) {
        $('.grid_column').show();
    }
    else {
        $('.grid_column').hide();
    }
  };
  $(update_grid);
  $('#listing_layout').change(update_grid);


  var update_sidebar = function () {
  	if ($('#on').is(":selected")) {
        $('.sidebar_position').show();
    }
    else {
        $('.sidebar_position').hide();
    }
  };
  $(update_sidebar);
  $('#turning_sidebar').change(update_sidebar);
});
