<?php //echo 'width="'.$image_meta['width'].'" height="'.$image_meta['height'].'"';?>
<div id="KeyShotXR" style="max-width: 100%;height:617px;" oncontextmenu="return false;">
	<img style="" id="placeholder" src="<?php echo $image_url; ?>" alt="<?php echo $alt;?>">
</div>
<style>
	.dicom-viewer__wrapper #KeyShotXR img {
		max-width: 100%;
		height:617px;
	}
	#KeyShotXR #placeholder:not(:only-child) {
		display: none;
	}
</style>
