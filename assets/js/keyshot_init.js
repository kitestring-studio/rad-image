
function initKeyShotXR(rad_keyshot_config) {
	let keyshot_id = "KeyShotXR-" + rad_keyshot_config.id;
	const width = document.getElementById(keyshot_id).offsetWidth;
	const height = document.getElementById(keyshot_id).offsetHeight;

	const nameOfDiv = keyshot_id;
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
	const loadingIcon = "../../../../../plugins/image-viewer/assets/img/Ball_and_arrow.webp"; // will need to calculate the number of parent levels in the path
	const allowFullscreen = false; // Double-click in desktop browsers for fullscreen.
	const uReverse = false;
	const vReverse = false;
	const hotspots = {};
	const isIBooksWidget = false;
	new keyshotXR(nameOfDiv, folderName, viewPortWidth, viewPortHeight, backgroundColor, uCount, vCount, uWrap, vWrap, uMouseSensitivity, vMouseSensitivity, uStartIndex, vStartIndex, minZoom, maxZoom, rotationDamping, downScaleToBrowser, addDownScaleGUIButton, downloadOnInteraction, imageExtension, showLoading, loadingIcon, allowFullscreen, uReverse, vReverse, hotspots, isIBooksWidget);
}
