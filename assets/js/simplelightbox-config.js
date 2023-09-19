(function () {

	const galleryElements = document.querySelectorAll('.rad-image__wrapper .gallery');
	for (let element of galleryElements) {
		setupGallery(element);
	}

	function setupGallery(galleryElement) {
		const options = {
			captionSelector: "img",
			captionType: "data",
			captionsData: "description",
			captionPosition: "outside",
			heightRatio: .85,
			// fadeSpeed: 0, // disable caption fadein, but also disables slide animation
		};

		const anchors = galleryElement.querySelectorAll("a");
		const thumbnails = Array.from(anchors).filter(function (item) {
			return /\.(jpe?g|png|gif|mp4|webp|bmp)(\?[^/]*)*$/i.test(item.getAttribute("href"));
		});

		for (const thumbnail of thumbnails) {
			thumbnail.classList.add('simplelightbox');
		}

		if (galleryElement.querySelectorAll('a.simplelightbox').length) {
			var simplelightbox = new SimpleLightbox(galleryElement.querySelectorAll('a.simplelightbox'), options);

			// ... (rest of the logic related to simplelightbox)
			simplelightbox.on('shown.simplelightbox', function () {
				// console.log('shown.simplelightbox')
				// fade('.sl-close', false, "0ms")
				positionCloseButton();
				// fade('.sl-close', true, "100ms")
				document.querySelector('.sl-close').classList.add('sl-ctl-style');
				document.querySelector('.sl-next').classList.add('sl-ctl-style');
				document.querySelector('.sl-prev').classList.add('sl-ctl-style');
			});

			simplelightbox.on('change.simplelightbox', function () {
				// console.log('change.simplelightbox')

				fade('.sl-close', false, "0ms")
				// document.querySelector('.sl-close').style.display = 'none';

			});

			simplelightbox.on('changed.simplelightbox', function () {
				// console.log("changed.simplelightbox")
				// set timer for 10 seconds
				setTimeout(function () {
					positionCloseButton();

					// document.querySelector('.sl-close').style.display = 'block';
					fade('.sl-close', true)

					// hide the close button
				}, 300)
			});

		}
	}


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

	function fade(selector, fadeIn, duration = '200ms') {
		var element = document.querySelector(selector);
		if (!element) return;

		// Set the transition property with the provided duration
		element.style.transition = `opacity ${duration}`;

		// Trigger reflow to ensure the transition starts
		element.offsetWidth;

		// Set the opacity based on the fadeIn parameter
		element.style.opacity = fadeIn ? '1' : '0';
		// console.log( fadeIn ? 'fadeIn' : 'fadeOut' , duration)
	}

})();
