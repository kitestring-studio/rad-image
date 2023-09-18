<?php

class RAD_Image_Viewer {
	private string $cpt_slug;
	private string $version;
	private string $plugin_url;
	private int $rs_image_id;
	private int $max_width; //@TODO unused?
	private float $aspect_ratio;

	function __construct( $version ) {
		$this->version    = $version;
		$this->cpt_slug   = 'rad_image';
		$this->plugin_url = dirname( plugin_dir_url( __FILE__ ) ); // @TODO set this to plugin root file

		$this->set_hooks();
	}

	/**
	 * @return void
	 */
	protected function set_hooks(): void {
		add_shortcode( 'rad_image', array( $this, 'rad_image_shortcode_func' ) );
		add_shortcode( 'dicom', array( $this, 'rad_image_shortcode_func' ) ); // deprecated

		add_filter( 'upload_dir', array( $this, 'wp_custom_upload_dir' ) );
		add_filter( 'intermediate_image_sizes_advanced', array( $this, 'remove_image_sizes' ), 1000 );

		// add meta box to the custom post type for copying the shortcode
		add_action( 'add_meta_boxes', array( $this, 'add_shortcode_meta_box' ) );
		add_action( 'acf/input/admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// @TODO add this hook only when needed
//		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_gallery_assets' ), 10 );
	}


	public function rad_image_shortcode_func( $atts ) {
		$atts = shortcode_atts(
			array( 'id' => '', 'max_width' => '750' ),
			$atts,
			'custom_post_type'
		);

		$this->max_width = (int) $atts['max_width'];
		$post_id         = (int) $atts['id'];

		if ( get_post_type( $post_id ) !== $this->cpt_slug ) {
			return '';
		}

		$this->rs_image_id = $post_id;
		$type              = get_field( 'type', $post_id );

		if ( ! in_array( $type, array( 'gallery', 'rotation', 'depth' ) ) ) {
			return '';
		}

		$images = get_field( 'images', $post_id );

		if ( ! $images ) {
			return '';
		}

		// bold, italics, and links are allowed in the caption
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'referrerpolicy' => array(),
				'title' => array(),
				'target' => array('_blank', '_self', '_parent', '_top'),
			),
			'b' => array(),
			'i' => array(),
			'strong' => array(),
			'span' => array(),
			'div' => array(),
			'br' => array(),
			'p' => array(),
		);

		$show_title = get_field( 'display_set_title', $post_id );
		$caption    = get_field( 'image_set_caption', $post_id );

		$tooltip_text   = get_field( "help_text_$type", $post_id );
		$edit_help_text = get_field( 'edit_help_text', $post_id );
		if ( empty( $tooltip_text ) || ! $edit_help_text ) {
			$tooltip_text = acf_get_field( "help_text_$type" )['default_value'];
		}

		ob_start();

		echo "<div class='rad-image__wrapper'>";

		$this->title_and_tooltip( $post_id, $show_title, $tooltip_text );

		$twoD = array();
		switch ( $type ) { // a = depth, b= rotation, c = gallery
			case 'rotation':
			case 'depth':
				$this->enqueue_viewer_assets();

				sort( $images );
				$image_url  = wp_get_attachment_url( end( $images ), 'full' );
				$image_meta = wp_get_attachment_metadata( end( $images ), 'full' );
				$alt        = get_post_meta( end( $images ), '_wp_attachment_image_alt', true );

				include plugin_dir_path( __FILE__ ) . 'keyshot-template.php';

				break;
			case 'gallery':
				$fixsupport = false;

				if ( ! current_theme_supports( 'html5', array( 'gallery' ) ) ) {
					add_theme_support( 'html5', array( 'gallery' ) ); //caption too?
					$fixsupport = true;
				}

				$this->enqueue_gallery_assets();

				add_filter( 'gallery_style', array( $this, 'gallery_style_func' ), 10, 1 );
				add_filter( 'wp_get_attachment_image_attributes', array( $this, 'set_attachment_captions' ), 10, 3 );

				echo do_shortcode( "[gallery id=$post_id size=medium link=file columns=2 ids='" . implode( ',', $images ) . "']" ); // @TODO test this!

				if ( $fixsupport ) {
					remove_theme_support( 'html5' );
				}
				break;
		}
		if ( $caption ) {
			echo '<p class="rad-image__set-caption">' . wp_kses( $caption, $allowed_html ) . '</p>';
		}

		echo '</div>'; // end rad-image__wrapper

		return ob_get_clean();
	}

	protected function title_and_tooltip( $post_id, $show_title, $tooltip ) {
		?>
		<div class="tooltip-wrapper">
			<div class="title_container"><?php
				if ( $show_title ) {
					$image_set_title = get_field( 'image_set_title', $post_id );
					echo '<h3 class="rad-image__title">' . esc_html( $image_set_title ) . '</h3>';
				}

				?></div>
			<div class="tooltip"><span class="dashicons dashicons-editor-help"></span>
				<span class="tooltiptext tooltip-left"><?php echo $tooltip; ?></span>
			</div>
		</div>
		<?php
	}

	public function enqueue_gallery_assets() {
		// check environment = production, use assets/dist, otherwise use node_modules
		$node_modules_installed = file_exists( dirname( plugin_dir_path( __FILE__ ) ) . '/node_modules/simplelightbox/dist' );

		if ( in_array( wp_get_environment_type(), [ 'local', 'development' ] ) && $node_modules_installed) {

			$dist = dirname( plugin_dir_url( __FILE__ ) ) . '/node_modules/simplelightbox/dist';

			wp_enqueue_script( 'simple-lightbox', $dist . '/simple-lightbox.js', array( 'jquery' ), $this->version, true );
//			wp_enqueue_script( 'simple-lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.1/simple-lightbox.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( 'simplelightbox-config', dirname( plugin_dir_url( __FILE__ ) ) . '/assets/js/simplelightbox-config.js', array( 'simple-lightbox' ), $this->version, true );

			wp_enqueue_style( 'rad-gallery', $dist . '/simple-lightbox.css', array(), $this->version, 'all' );
		} else {
			$dist = $this->plugin_url . '/dist';

			wp_enqueue_script( 'rad-gallery', $dist . '/gallery.bundle.js', array( 'jquery' ), $this->version, true );

			wp_enqueue_style( 'rad-gallery', $dist . '/gallery.bundle.css', array(), $this->version, 'all' );
		}

		wp_enqueue_style( 'rad-image-viewer', $this->plugin_url . '/assets/css/rad-image-viewer.css', array( 'dashicons' ), $this->version, 'all' );
	}

	public function enqueue_viewer_assets() {
		wp_enqueue_style( 'rad-image-viewer', $this->plugin_url . '/assets/css/rad-image-viewer.css', array( 'dashicons' ), $this->version, 'all' );

		wp_enqueue_script( 'keyshotxr', $this->plugin_url . '/assets/js/KeyShotXR.js', array(), $this->version, true );
		wp_enqueue_script( 'keyshot-init', $this->plugin_url . '/assets/js/keyshot_init.js', array( 'keyshotxr' ), $this->version, true );

		$keyshot_config = $this->get_keyshot_config();
		wp_localize_script( 'keyshot-init', 'rad_keyshot_config', $keyshot_config );
	}

	/**
	 * This function filters wp_get_attachment_image_attributes to add the caption and description
	 * to the image data attributes for use by simplelightbox
	 *
	 * @param array $attr
	 * @param WP_Post $attachment
	 * @param $size
	 *
	 * @return array
	 */
	function set_attachment_captions( array $attr, WP_Post $attachment, $size ): array {
		$attr['data-description'] = $attachment->post_content;
		$attr['data-caption']     = $attachment->post_excerpt;

		return $attr;
	}

	// filter for gallery_style to add a class to the gallery
	public function gallery_style_func( $style ) {
		// check for viewer post type
		if ( isset( $this->rs_image_id ) && get_post_type( $this->rs_image_id ) !== $this->cpt_slug ) {
			return $style;
		}

		$style = $this->set_attribute_value( $style, 'class', 'is-layout-flex' );
		// strip closing </div> tag from the $style string
		$style = str_replace( '</div>', '', $style );

		return $style;
	}

	/**
	 * @param $html_tag
	 * @param $attribute_name
	 * @param $new_value
	 * @param $position - 'before' or 'after'
	 *
	 * @return false|mixed|string
	 */
	function set_attribute_value( $html_tag, $attribute_name, $new_value, $position = null ) {
		$dom = new DOMDocument();
		$dom->loadHTML( $html_tag );

		// Use getElementsByTagName() to search for the specified tag
		$tags = $dom->getElementsByTagName( '*' );

		// Check if any tags were found
		if ( $tags->length > 0 ) {
			// Get the first tag found, after html & body
			$tag = $tags->item( 2 );

			$attribute_value = $tag->getAttribute( $attribute_name );

			switch ( $position ) {
				case $position === 'start':
					$attribute_value = $new_value . ' ' . $attribute_value;
					break;
				case $position === 'end':
					$attribute_value = $attribute_value . ' ' . $new_value;
					break;
				default:
					$attribute_value = $new_value;
			}

			$tag->setAttribute( $attribute_name, $attribute_value );

			return $dom->saveHTML( $tag );
		} else {
			return $html_tag;
		}
	}


	/**
	 * @param bool|string $image_url
	 * @param string $request_url
	 *
	 * @return string
	 */
	function get_backtrack_url( string $image_url, string $request_url ): string {
		$image_root_relative_url = wp_make_link_relative( $image_url ); // @TODO unused?

		// get relative path of upload directory
		$upload_dir          = wp_make_link_relative( wp_upload_dir()['baseurl'] );
		$image_relative_path = _wp_get_attachment_relative_path( $image_url );
		$image_dir_path      = "$upload_dir/$image_relative_path";

		// split the $request url into an array, and remove empty elements
		$request_url_array = array_filter( explode( '/', $request_url ) );

		// delete empty array elements, and then create a backtrack string for $image_dir_path

		$backtrack_string = implode( '', array_map( function ( $element ) {
			return '../';
		}, $request_url_array ) );

		// create the final path to the image directory
		$image_dir_path_final = untrailingslashit( $backtrack_string ) . $image_dir_path;

		return $image_dir_path_final;
	}


	public function wp_custom_upload_dir( $param ) {
		// Check if this is a rad_image post and if the images field is being used
		$post_id   = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
		$field_key = isset( $_POST['_acfuploader'] ) ? sanitize_text_field( $_POST['_acfuploader'] ) : '';
		if ( $this->cpt_slug !== get_post_type( $post_id ) || 'field_638c863653019' !== $field_key ) { // @TODO remove hardcoded field key
			return $param;
		}

		// Set a custom upload directory
		$time          = current_time( 'mysql' );
		$y             = substr( $time, 0, 4 );
		$m             = substr( $time, 5, 2 );
		$param['path'] = $param['basedir'] . "/$y/$m/rad-$post_id";
		$param['url']  = $param['baseurl'] . "/$y/$m/rad-$post_id";

		return $param;
	}

// prevent wordpress from creating alternate image resolutions for "rad_image" custom post type
// @TODO add thumbnail size back in
	function remove_image_sizes( $sizes ) {
		$post_id = (int) $_REQUEST['post_id'] ?? 0;

		if ( $this->cpt_slug === get_post_type( $post_id ) ) {
			return array();
		}

		return $sizes;
	}

	/**
	 * @param mixed $images
	 * @param array $twoD
	 *
	 * @return array
	 */
	protected function get_y_count( array $images ): array {
		$twoD = array();
		foreach ( $images as $image_id ) {
			$filename = wp_basename( get_attached_file( $image_id ) );
			// strip off the extension
			$filename            = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $filename );
			$split               = explode( '_', $filename );
			$twoD[ $split[0] ][] = (int) $image_id;
		}

		sort( $twoD );
		$x_count = count( $twoD );
		// make sure each sub array has the same number of elements
		$y_count = 0;
		foreach ( $twoD as $x ) {
			$y_count = max( $y_count, count( $x ) );
		}

		return array( $x_count, $y_count );
	}

	function enqueue_admin_scripts() {
		wp_enqueue_script( 'rad-viewer-admin', dirname( plugin_dir_url( __FILE__ ) ) . '/assets/js/rad-image-viewer-admin.js', array(), $this->version, true );
	}


	function add_shortcode_meta_box() {
		add_meta_box(
			'rad_shortcode_meta_box',
			'Shortcode',
			array( $this, 'rad_shortcode_meta_box_callback' ),
			'rad_image',
			'side',
			'low'
		);
	}

	function rad_shortcode_meta_box_callback( $post ) {
		$post_id   = $post->ID;
		$shortcode = "[rad_image id=$post_id]";

		if ( ! $post_id ) {
			$shortcode = 'Save post to generate shortcode';
		}

		echo '<input type="text" id="rad_shortcode_field" value="' . $shortcode . '" readonly>';
		echo '<button id="copy_rad_shortcode" style="border:0px; background-color:transparent;cursor:pointer"><span class="dashicons dashicons-clipboard"></span></button>';
	}

	/**
	 * @return array
	 */
	protected function get_keyshot_config(): array {
		$post_id            = $this->rs_image_id;
		$image_array        = get_field( 'images', $post_id );
		$image_url          = wp_get_attachment_url( $image_array[0], 'full' );
		$image_meta         = wp_get_attachment_metadata( $image_array[0], 'full' );
		$this->aspect_ratio = floatval( $image_meta['height'] / $image_meta['width'] );

		// get relative url of the page that requested the image, for KeyShot
		$request_url          = wp_make_link_relative( get_permalink() );
		$image_dir_path_final = $this->get_backtrack_url( $image_url, $request_url );

		$type = get_field( 'type', $post_id );
		[ $x_count, $y_count ] = $this->get_y_count( $image_array );

		if ( $type === 'rotation' ) {
			$vCount      = $x_count;
			$uCount      = $y_count;
			$vStartIndex = 0;
			$uStartIndex = $y_count - 1; // @TODO should this be 0? Why are we starting from the end?
		} elseif ( $type === 'depth' ) {
			$vCount      = $x_count;
			$uCount      = $y_count;

			// @TODO testing here
			$vStartIndex = (int) floor( $x_count / 2 );
			$uStartIndex = 0;
		} else {
			// shouldn't be able to get here, fail silently
			return array();
		}

		return array(
			'vCount'      => $vCount,
			'uCount'      => $uCount,
			'vStartIndex' => $vStartIndex,
			'uStartIndex' => $uStartIndex,
			'maxZoom'     => ( $type === 'rotation' ) ? 2 : 1,
			'folderName'  => $image_dir_path_final,
			'imageWidth'  => $image_meta['width'], // no longer used
			'imageHeight' => $image_meta['height'], // no longer used
		);
	}
}
