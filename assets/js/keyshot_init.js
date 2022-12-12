var keyshotXR;

function initKeyShotXR() {
	console.log(dicom_viewer_data.image_set_count)
	var nameOfDiv = "KeyShotXR";
	// var folderName = "../../wp-content/uploads/2022/12"; //will need to calculate the number of parent folders in the path
	var folderName = dicom_viewer_data.folderName;
	var viewPortWidth = 900;
	var viewPortHeight = 900;
	var backgroundColor = "#FFFFFF";
	// var uCount = 40; // get count from items uploaded to gallery field
	var uCount = parseInt(dicom_viewer_data.image_set_count);
	var vCount = 1;
	var uWrap = false;
	var vWrap = false;
	var uMouseSensitivity = -0.05;
	var vMouseSensitivity = 0.05;
	// var uStartIndex = 39;// Will the starting frame always be the largest file number?
	var uStartIndex = parseInt(dicom_viewer_data.image_set_count) - 1;
	var vStartIndex = 0;
	var minZoom = 1;
	var maxZoom = 2;
	var rotationDamping = 0.8;
	var downScaleToBrowser = true;
	var addDownScaleGUIButton = false;
	var downloadOnInteraction = false;
	var imageExtension = "jpg";
	var showLoading = true;
	var loadingIcon = "../../../../plugins/dicom-viewer-plugin/assets/img/Ball_and_arrow.webp"; // will need to calculate the number of parent levels in the path
	var allowFullscreen = true; // Double-click in desktop browsers for fullscreen.
	var uReverse = false;
	var vReverse = false;
	var hotspots = {};
	var isIBooksWidget = false;
	keyshotXR = new keyshotXR(nameOfDiv, folderName, viewPortWidth, viewPortHeight, backgroundColor, uCount, vCount, uWrap, vWrap, uMouseSensitivity, vMouseSensitivity, uStartIndex, vStartIndex, minZoom, maxZoom, rotationDamping, downScaleToBrowser, addDownScaleGUIButton, downloadOnInteraction, imageExtension, showLoading, loadingIcon, allowFullscreen, uReverse, vReverse, hotspots, isIBooksWidget);
}

window.onload = initKeyShotXR;
