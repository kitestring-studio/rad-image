<?php

class Dicom_Viewer {
	private string $cpt_slug;
	private string $version;
	private int $dicom_id;
	private array $lightbox_options_backup;

	function __construct( $version ) {
		if ( class_exists( 'SimpleLightbox' ) ) {
			$this->lightbox = SimpleLightbox::get_instance();
		}

		$this->version = $version;
		$this->cpt_slug = 'dicom';

		$this->set_hooks();

	}

	/**
	 * @return void
	 */
	protected function set_hooks(): void {
		add_shortcode( 'rad_image', array( $this, 'dicom_shortcode_func' ) );
		add_shortcode( 'dicom', array( $this, 'dicom_shortcode_func' ) ); // deprecated

		add_filter( 'upload_dir', array( $this, 'wp_custom_upload_dir' ) );
		add_filter( 'intermediate_image_sizes_advanced', array( $this, 'remove_image_sizes' ), 1000 );

		// filter gallery_style with a method named gallery_style_func
		add_filter( 'gallery_style', array( $this, 'gallery_style_func' ), 10, 1 );

		// add meta box to the custom post type for copying the shortcode
		add_action( 'add_meta_boxes', array($this, 'add_dicom_shortcode_meta_box') );
		add_action('acf/input/admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts'));

		// @TODO add this hook only when needed
		add_action( 'wp_enqueue_scripts', array( $this, 'dicom_viewer_enqueue_styles' ), 20 );

	}


	public function dicom_shortcode_func( $atts ) {
		$atts = shortcode_atts(
			array( 'id' => '' ),
			$atts,
			'custom_post_type'
		);

		$post_id = (int) $atts['id'];
		if ( get_post_type( $post_id ) !== $this->cpt_slug ) {
			return '';
		}
		$this->dicom_id = $post_id;

		$type = get_field( 'type', $post_id );
		if ( ! in_array( $type, array( 'gallery', 'rotation', 'depth' ) ) ) {
			return '';
		}

		$images = get_field( 'images', $post_id );
		if ( ! $images ) {
			return '';
		}

		$show_title = get_field( 'display_set_title', $post_id );
		$caption    = get_field( 'image_set_caption', $post_id );

		ob_start();

		echo "<div class='dicom-viewer__wrapper'>";

		if ( $show_title ) {
			$image_set_title = get_field( 'image_set_title', $post_id );
			echo '<h2>' . esc_html( $image_set_title ) . '</h2>';
		}

		$twoD = array();
		switch ( $type ) { // a = depth, b= rotation, c = gallery
			case 'rotation':
			case 'depth':
				sort( $images );
				$this->dicom_viewer_enqueue_scripts();

				include plugin_dir_path( __FILE__ ) . 'dicom-template.php';

				break;
			case 'gallery':
				qm( 'gallery' );
//				$this->override_lightbox_options();
//				add_action( 'wp_enqueue_scripts', array( $this, 'dicom_viewer_enqueue_styles' ), 10 );
				add_filter( 'wp_get_attachment_image_attributes', array( $this, 'set_attachment_captions' ), 10, 3 );
				echo do_shortcode( "[gallery id=$post_id size=medium link=file columns=2 ids='" . implode( ',', $images ) . "']" ); // @TODO test this!
//				$this->restore_lightbox_options();
				break;
		}
		if ( $caption ) {
			echo '<p>' . esc_html( $caption ) . '</p>';
		}

		echo '</div>';

		return ob_get_clean();
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
		// check for dicom post type
		if ( isset( $this->dicom_id ) && get_post_type( $this->dicom_id ) !== $this->cpt_slug ) {
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

	public function dicom_viewer_enqueue_styles() {
		wp_dequeue_script('simplelightbox-call');
		wp_localize_script('simplelightbox-call', 'php_vars', $this->lightbox->options);
		wp_enqueue_script('simplelightbox-call');
		wp_enqueue_style( 'dicom-viewer', dirname( plugin_dir_url( __FILE__ ) ) . '/assets/css/dicom-viewer.css', array(), $this->version, 'all', true );
	}
	public function dicom_viewer_enqueue_scripts() {
//	if ( is_singular( 'dicom' ) ) {
		$plugin_root_url = dirname( plugin_dir_url( __FILE__ ) ); // @TODO set this to plugin root file
		do_action( 'qm/debug', [ '$plugin_root_url', $plugin_root_url ] );

		wp_enqueue_script( 'keyshotxr', qm( $plugin_root_url . '/assets/js/KeyShotXR.js' ), array(), $this->version, true );
		wp_enqueue_script( 'keyshot-init', $plugin_root_url . '/assets/js/keyshot_init.js', array(), $this->version, true );

		$post_id = $this->dicom_id;

		$image_array  = get_field( 'images', $post_id );

		// get the image URL
		$image_url = wp_get_attachment_url( $image_array[0], 'full' );


		// get relative url of the page that requested the image
		$request_url = wp_make_link_relative( get_permalink() );
		$image_dir_path_final = $this->get_backtrack_url( $image_url, $request_url );

		// a = depth, b= rotation, c = gallery
		$type = get_field( 'type', $post_id );
		[$x_count, $y_count] = $this->get_y_count( $image_array );

		if ( $type === 'rotation' ) {
			$vCount = $x_count;
			$uCount = $y_count;
			$vStartIndex = 0;
			$uStartIndex = $y_count - 1;
		} elseif ( $type === 'depth' ) {
			$vCount = $x_count;
			$uCount = $y_count;
			$vStartIndex = $x_count - 1;
			$uStartIndex = 0;
		} else {
			return;
		}

		$dynamic_data = array(
			'vCount'      => $vCount,
			'uCount'      => $uCount,
			'vStartIndex' => $vStartIndex,
			'uStartIndex' => $uStartIndex,
			'maxZoom'     => ( $type === 'rotation' ) ? 2 : 1,
			'folderName'  => $image_dir_path_final,
		);
		wp_localize_script( 'keyshot-init', 'dicom_viewer_data', $dynamic_data );
//	}
	}


	/**
	 * @param bool|string $image_url
	 * @param string $request_url
	 *
	 * @return string
	 */
	function get_backtrack_url( string $image_url, string $request_url ): string {
		$image_root_relative_url = wp_make_link_relative( $image_url );


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
		// Check if this is a dicom post and if the images field is being used
		$post_id   = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
		$field_key = isset( $_POST['_acfuploader'] ) ? sanitize_text_field( $_POST['_acfuploader'] ) : '';
		if ( $this->cpt_slug !== get_post_type( $post_id ) || 'field_638c863653019' !== $field_key ) { // @TODO remove hardcoded field key
			return $param;
		}

		// Set a custom upload directory
		$time          = current_time( 'mysql' );
		$y             = substr( $time, 0, 4 );
		$m             = substr( $time, 5, 2 );
		$param['path'] = $param['basedir'] . "/$y/$m/dicom-$post_id";
		$param['url']  = $param['baseurl'] . "/$y/$m/dicom-$post_id";

		return $param;
	}


// prevent wordpress from creating alternate image resolutions for "dicom" custom post type
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

		return array($x_count, $y_count) ;
	}

	function enqueue_admin_scripts() {
		wp_enqueue_script( 'dicom-viewer-admin', dirname( plugin_dir_url( __FILE__ ) ) . '/assets/js/dicom-viewer-admin.js', array(), $this->version, true );
	}


	function add_dicom_shortcode_meta_box() {
		add_meta_box(
			'dicom_shortcode_meta_box',
			'Shortcode',
			array( $this, 'dicom_shortcode_meta_box_callback' ),
			'dicom',
			'side',
			'low'
		);
	}

	function dicom_shortcode_meta_box_callback( $post ) {
		$post_id = $post->ID;
		$shortcode = "[dicom id=$post_id]";

		if ( ! $post_id ) {
			$shortcode = 'Save post to generate shortcode';
		}

		echo '<input type="text" id="dicom_shortcode_field" value="'. $shortcode .'" readonly>';
		echo '<button id="copy_dicom_shortcode" style="border:0px; background-color:transparent;cursor:pointer"><span class="dashicons dashicons-clipboard"></span></button>';
	}

	/**
	 * @return void
	 */
	protected function override_lightbox_options(): void {
		if ( ! $this->lightbox || ! $this->lightbox->options ) {
			return;
		}

		$this->backup_lightbox_options();

		$this->lightbox->options['ar_sl_captionSelector'] = 'img';
		$this->lightbox->options['ar_sl_captionType']     = 'data';
		$this->lightbox->options['ar_sl_captionData']     = 'description';
	}

	/**
	 * @return void
	 */
	protected function backup_lightbox_options(): void {
		$this->lightbox_options_backup = $this->lightbox->options;
	}

	//restore lightbox options
	protected function restore_lightbox_options(): void {
		if ( ! $this->lightbox || ! $this->lightbox->options_backup ) {
			return;
		}

		$this->lightbox->options = $this->lightbox_options_backup;
	}
}
