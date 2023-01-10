<?php
class Dicom_Viewer {
	private string $cpt_slug;

	function __construct() {
		$this->cpt_slug = 'dicom';

		$this->set_hooks();

	}

	/**
	 * @return void
	 */
	protected function set_hooks(): void {
		add_shortcode( 'dicom', array( $this, 'dicom_shortcode_func' ) );
		add_filter( 'upload_dir', array( $this, 'wp_custom_upload_dir' ) );
		add_filter( 'intermediate_image_sizes_advanced', array( $this, 'remove_image_sizes' ), 1000 );

		// filter gallery_style with a method named gallery_style_func
		add_filter( 'gallery_style', array( $this, 'gallery_style_func' ), 10, 1 );
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
		if ( ! in_array( $type, array( 'a', 'b', 'c' ) ) ) {
			return '';
		}

		ob_start();

		$show_title = get_field( 'display_set_title', $post_id );
		if ( $show_title ) {
			$image_set_title = get_field( 'image_set_title', $post_id );
			echo '<h2>' . esc_html( $image_set_title ) . '</h2>';
		}


		$images          = get_field( 'images', $post_id );

		$image_count       = count( $images );
		$one_image_id      = (int) $images[ $image_count - 1 ];
		$placeholder_image = wp_get_attachment_url( $one_image_id, 'full' );

		switch ( $type ) {
			case 'a':
			case 'b':
				sort( $images );
				add_action( 'wp_enqueue_scripts', array( $this, 'dicom_viewer_enqueue_scripts' ), 10 );

				include plugin_dir_path( __FILE__ ) . 'dicom-template.php';

				break;
			case 'c':
				echo do_shortcode( "[gallery size=medium link=file columns=2 ids='" . implode( ',', $images ) . "']" ); // @TODO test this!
				break;
		}

		return ob_get_clean();
	}

	// filter for gallery_style to add a class to the gallery
	public function gallery_style_func( $style ) {
		// check for dicom post type
		if ( get_post_type( $this->dicom_id ) !== $this->cpt_slug ) {
			return $style;
		}

		$style = $this->set_attribute_value($style, 'class', 'is-layout-flex');
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


	public function dicom_viewer_enqueue_scripts() {
//	if ( is_singular( 'dicom' ) ) {
		$plugin_root_url = dirname( plugin_dir_url( __FILE__ ) ); // @TODO set this to plugin root file
		do_action( 'qm/debug', ['$plugin_root_url', $plugin_root_url] );

		wp_enqueue_script( 'keyshotxr', qm($plugin_root_url . '/assets/js/KeyShotXR.js'), array(), '1.0', true );
		wp_enqueue_script( 'keyshot-init', $plugin_root_url . '/assets/js/keyshot_init.js', array(), '1.0', true );

		$post_id = $this->dicom_id;

		$image_array  = get_field( 'images', $post_id );
		$image_count  = count( $image_array );
		$one_image_id = (int) $image_array[0];

		// get the image URL
		$image_url = wp_get_attachment_url( $one_image_id, 'full' );


		// get relative url of the page that requested the image
		$request_url = wp_make_link_relative( get_permalink() );


		$image_dir_path_final = $this->get_backtrack_url( $image_url, $request_url );

		// a = depth, b= rotation, c = gallery
		$type = get_field( 'type', $post_id );;

		$dynamic_data = array(
			'vCount'      => ( $type === 'a' ) ? $image_count : 1,
			'uCount'      => ( $type === 'b' ) ? $image_count : 1,
			'vStartIndex' => ( $type === 'a' ) ? $image_count - 1 : 0,
			'uStartIndex' => ( $type === 'b' ) ? $image_count - 1 : 0,
			'maxZoom'     => ( $type === 'b' ) ? 2 : 1,
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


}
