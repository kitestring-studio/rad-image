var keyshotXR;

function initKeyShotXR() {
	// console.log(rad_keyshot_config)
	// let image_width = rad_keyshot_config.imageWidth;
	// let image_height = rad_keyshot_config.imageHeight;

	// get width of the element #KeyShotXR
	const width = document.getElementById("KeyShotXR").offsetWidth;
	const height = document.getElementById("KeyShotXR").offsetHeight;
	//calculate the dimensions of the image based on the width of the element
	// const height = (image_height / image_width) * width;

	//set the height of the element to the calculated height
	// document.getElementById("KeyShotXR").style.height = height + "px";

	const nameOfDiv = "KeyShotXR";
	// const folderName = "../../wp-content/uploads/2022/12"; //will need to calculate the number of parent folders in the path
	const folderName = rad_keyshot_config.folderName;
	const viewPortWidth = width;
	const viewPortHeight = height;
	const backgroundColor = "#FFFFFF";
	const uCount = parseInt(rad_keyshot_config.uCount);
	const vCount = parseInt(rad_keyshot_config.vCount);
	const uWrap = false;
	const vWrap = false;
	const uMouseSensitivity = -0.05;
	const vMouseSensitivity = 0.05;
	// const uStartIndex = 39;// Will the starting frame always be the largest file number?
	const uStartIndex = parseInt(rad_keyshot_config.uStartIndex);
	const vStartIndex = parseInt(rad_keyshot_config.vStartIndex);
	const minZoom = 1;
	const maxZoom = 1; //disable for depth zoom
	const rotationDamping = 0.8;
	const downScaleToBrowser = true;
	const addDownScaleGUIButton = false;
	const downloadOnInteraction = false;
	const imageExtension = "jpg";
	const showLoading = true;
	const loadingIcon = "../../../../../plugins/rad-image/assets/img/Ball_and_arrow.webp"; // will need to calculate the number of parent levels in the path
	const allowFullscreen = true; // Double-click in desktop browsers for fullscreen.
	const uReverse = false;
	const vReverse = false;
	const hotspots = {};
	const isIBooksWidget = false;
	keyshotXR = new keyshotXR(nameOfDiv, folderName, viewPortWidth, viewPortHeight, backgroundColor, uCount, vCount, uWrap, vWrap, uMouseSensitivity, vMouseSensitivity, uStartIndex, vStartIndex, minZoom, maxZoom, rotationDamping, downScaleToBrowser, addDownScaleGUIButton, downloadOnInteraction, imageExtension, showLoading, loadingIcon, allowFullscreen, uReverse, vReverse, hotspots, isIBooksWidget);
}

window.onload = initKeyShotXR;
