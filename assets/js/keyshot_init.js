var keyshotXR;

function initKeyShotXR() {
	console.log(rad_keyshot_config)
	var nameOfDiv = "KeyShotXR";
	// var folderName = "../../wp-content/uploads/2022/12"; //will need to calculate the number of parent folders in the path
	var folderName = rad_keyshot_config.folderName;
	var viewPortWidth = 617;
	var viewPortHeight = 617;
	var backgroundColor = "#FFFFFF";
	// var uCount = 40; // get count from items uploaded to gallery field
	var uCount = parseInt(rad_keyshot_config.uCount);
	var vCount = parseInt(rad_keyshot_config.vCount);
	var uWrap = false;
	var vWrap = false;
	var uMouseSensitivity = -0.05;
	var vMouseSensitivity = 0.05;
	// var uStartIndex = 39;// Will the starting frame always be the largest file number?
	var uStartIndex = parseInt(rad_keyshot_config.uStartIndex);
	var vStartIndex = parseInt(rad_keyshot_config.vStartIndex);
	var minZoom = 1;
	var maxZoom = 2; //disable for depth zoom
	var rotationDamping = 0.8;
	var downScaleToBrowser = true;
	var addDownScaleGUIButton = false;
	var downloadOnInteraction = false;
	var imageExtension = "jpg";
	var showLoading = true;
	var loadingIcon = "../../../../../plugins/dicom-viewer-plugin/assets/img/Ball_and_arrow.webp"; // will need to calculate the number of parent levels in the path
	var allowFullscreen = true; // Double-click in desktop browsers for fullscreen.
	var uReverse = false;
	var vReverse = false;
	var hotspots = {};
	var isIBooksWidget = false;
	keyshotXR = new keyshotXR(nameOfDiv, folderName, viewPortWidth, viewPortHeight, backgroundColor, uCount, vCount, uWrap, vWrap, uMouseSensitivity, vMouseSensitivity, uStartIndex, vStartIndex, minZoom, maxZoom, rotationDamping, downScaleToBrowser, addDownScaleGUIButton, downloadOnInteraction, imageExtension, showLoading, loadingIcon, allowFullscreen, uReverse, vReverse, hotspots, isIBooksWidget);
}

window.onload = initKeyShotXR;
