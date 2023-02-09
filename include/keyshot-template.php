<?php //echo 'width="'.$image_meta['width'].'" height="'.$image_meta['height'].'"';?>
<div id="KeyShotXR" style="max-width: 100%;height:<?php echo $this->placeholder_height ?>px" oncontextmenu="return false;">
<!--	<img style="" id="placeholder" src="--><?php //echo $image_url; ?><!--" alt="--><?php //echo $alt;?><!--">-->
</div>
<style>
	.rad-image__wrapper #KeyShotXR {
		margin-bottom: 2rem;
	}
	.rad-image__wrapper #KeyShotXR img {
		max-width: 100%;
	}
	#KeyShotXR #placeholder:not(:only-child) {
		display: none;
	}
</style>
