
// run on document ready without jquery
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("copy_rad_shortcode").addEventListener("click", function(e) {
		e.preventDefault();

		const rad_shortcode_field = document.getElementById("rad_shortcode_field");
		rad_shortcode_field.select();
		rad_shortcode_field.setSelectionRange(0, 99999); // For mobile devices

		// document.execCommand("copy");
		navigator.clipboard.writeText(rad_shortcode_field.value);

	});

});

// @TODO make this work
jQuery('input[name="acf[field_63974fe0e18e1]"]').change(function ($input) {
	console.log('changed')
	// toggle visibility of the .acf-gallery-sort dropdown. hidden when 'gallery' is selected

})

/*acf.addAction( 'change', function( $input ) {
	if ( $input.attr('type') === 'radio' && $input.attr('name') === 'type' ) {
		var selectedValue = $input.val();
		console.log('changed to ' + selectedValue)
	}
});*/
