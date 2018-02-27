jQuery(document).ready(function($) {
	var update_grid = function () {
  	if ($("#grid").is(":selected")) {
        $('.grid_column').show();
    }
    else {
        $('.grid_column').hide();
    }
  };
  $(update_grid);
  $("#listing_layout").change(update_grid);
});
