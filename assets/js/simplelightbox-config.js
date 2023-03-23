(function () {

	const options = {
		captionSelector: "img",
		captionType: "data",
		captionsData: "description",
	};

	const anchors = document.querySelectorAll("a");
	const thumbnails = Array.from(anchors).filter(function (item) {
		return /\.(jpe?g|png|gif|mp4|webp|bmp)(\?[^/]*)*$/i.test(item.getAttribute("href"));
	});

	for (const thumbnail of thumbnails) {
		thumbnail.classList.add('simplelightbox');
	}

	if (document.querySelectorAll('a.simplelightbox').length) {
		var simplelightbox = new SimpleLightbox('a.simplelightbox', options);
	}

	// let gallery = new SimpleLightbox('.gallery a');
	simplelightbox.on('shown.simplelightbox', function () {
		positionCloseButton();
		document.querySelector('.sl-close').classList.add('sl-ctl-style');
		document.querySelector('.sl-next').classList.add('sl-ctl-style');
		document.querySelector('.sl-prev').classList.add('sl-ctl-style');
	});

	function positionCloseButton() {
		const slImageEl = document.querySelector('.sl-image');
		const slCloseEl = document.querySelector('.sl-close');

		// Get the coordinates of the top-right corner of the .sl-image element
		const { top, right } = slImageEl.getBoundingClientRect();
		const centerX = right;
		const centerY = top;

		// Set the position of .sl-close to the center of .sl-image
		slCloseEl.style.position = 'absolute';
		// slCloseEl.style.left = `${centerX - (slCloseEl.offsetWidth / 2)}px`;
		// slCloseEl.style.top = `${centerY - (slCloseEl.offsetHeight / 2)}px`;
		slCloseEl.style.left = `${centerX}px`;
		slCloseEl.style.top = `${centerY}px`;
	}

})();
