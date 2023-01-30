
// run on document ready without jquery
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("copy_dicom_shortcode").addEventListener("click", function(e) {
		e.preventDefault();

		const dicom_shortcode_field = document.getElementById("dicom_shortcode_field");
		dicom_shortcode_field.select();
		dicom_shortcode_field.setSelectionRange(0, 99999); // For mobile devices

		// document.execCommand("copy");
		navigator.clipboard.writeText(dicom_shortcode_field.value);

	});

})();
