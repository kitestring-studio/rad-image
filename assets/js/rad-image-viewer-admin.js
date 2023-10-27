
// run on document ready without jquery
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("copy_rad_shortcode").addEventListener("click", function(e) {
		e.preventDefault();

		const rad_shortcode_field = document.getElementById("rad_shortcode_field");
		rad_shortcode_field.select();
		rad_shortcode_field.setSelectionRange(0, 99999); // For mobile devices

		// document.execCommand("copy");
		navigator.clipboard.writeText(rad_shortcode_field.value);

		// display a visual confirmation
		const copy_rad_shortcode = document.getElementById("copy_rad_shortcode");
		const dashicon = copy_rad_shortcode.querySelector('.dashicons');
		dashicon.classList.remove('dashicons-clipboard');
		dashicon.classList.add('dashicons-yes-alt');

		copy_rad_shortcode.classList.add('copied');
		setTimeout(function () {
			dashicon.classList.add('dashicons-clipboard');
			dashicon.classList.remove('dashicons-yes-alt');
			copy_rad_shortcode.classList.remove('copied');
		}, 1000);

	});

	handleTypeChange(jQuery('input[name="acf[field_63974fe0e18e1]"]:checked'))
	jQuery('input[name="acf[field_63974fe0e18e1]"]').change(function (e) {
		handleTypeChange(e.target);
	})

});


function handleTypeChange(input) {
	"use strict";

	// console.log('changed')
	let type = jQuery(input).attr('value');
	// console.log(type)

	// toggle visibility of the .acf-gallery-sort dropdown. hidden when 'gallery' is selected
	if (type === 'gallery') {
		// jQuery('body').addClass('rad-image-gallery'); // @TODO set body class for hiding gallery fields
		jQuery('.acf-gallery-sort').fadeIn()
		// hide image title field
		// hide image title field
		// jQuery('.acf-field-text').hide()
	} else {
		// jQuery('body').addClass('rad-image-' + type); // @TODO set body class for hiding gallery fields
		jQuery('.acf-gallery-sort').fadeOut()
		// hide image title field
		// hide image caption field
		// hide image description field
	}
}

// @TODO use this native ACF hook instead?
/*acf.addAction( 'change', function( $input ) {
	console.log('changed')
	if ( $input.attr('type') === 'radio' && $input.attr('name') === 'type' ) {
		var selectedValue = $input.val();
		console.log('changed to ' + selectedValue)
	}
});*/
