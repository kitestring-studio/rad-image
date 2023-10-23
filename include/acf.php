<?php

add_action( 'acf/include_fields', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_638c84c216521',
		'title'                 => 'RAD Image Viewer',
		'fields'                => array(
			array(
				'key'               => 'field_63974fe0e18e1',
				'label'             => 'Type',
				'name'              => 'type',
				'aria-label'        => '',
				'type'              => 'radio',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '25',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'gallery'  => 'Gallery',
					'rotation' => 'Rotation',
					'depth'    => 'Depth',
					'single'   => 'Single',
				),
				'default_value'     => 'a',
				'return_format'     => 'value',
				'allow_null'        => 0,
				'other_choice'      => 0,
				'layout'            => 'vertical',
				'save_other_choice' => 0,
			),
			array(
				'key'               => 'field_638c84c253017',
				'label'             => 'Image Set Title',
				'name'              => 'image_set_title',
				'aria-label'        => '',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '50',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'maxlength'         => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
			),
			array(
				'key'                       => 'field_638c85e653018',
				'label'                     => 'Display Set Title',
				'name'                      => 'display_set_title',
				'aria-label'                => '',
				'type'                      => 'checkbox',
				'instructions'              => '',
				'required'                  => 0,
				'conditional_logic'         => 0,
				'wrapper'                   => array(
					'width' => '25',
					'class' => '',
					'id'    => '',
				),
				'choices'                   => array(
					'true' => 'Display on frontend',
				),
				'default_value'             => array(
					0 => 'true',
				),
				'return_format'             => 'value',
				'allow_custom'              => 0,
				'layout'                    => 'vertical',
				'toggle'                    => 0,
				'save_custom'               => 0,
				'custom_choice_button_text' => 'Add new choice',
			),
			array(
				'key'                => 'field_63bdeab575c28',
				'label'              => 'Image Set Caption',
				'name'               => 'image_set_caption',
				'aria-label'         => '',
				'type'               => 'textarea',
				'instructions'       => '',
				'required'           => 0,
				'conditional_logic'  => 0,
				'wrapper'            => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'      => '',
				'acfe_textarea_code' => 0,
				'maxlength'          => '',
				'rows'               => 3,
				'placeholder'        => '',
				'new_lines'          => '',
			),
			array(
				'key'               => 'field_65354d29a6e22',
				'label'             => 'Start Frame',
				'name'              => 'start_frame',
				'aria-label'        => '',
				'type'              => 'radio',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_63974fe0e18e1',
							'operator' => '==',
							'value'    => 'depth',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					0  => 'First',
					50 => 'Middle',
				),
				'default_value'     => 50,
				'return_format'     => 'value',
				'allow_null'        => 0,
				'other_choice'      => 0,
				'layout'            => 'vertical',
				'save_other_choice' => 0,
			),
			array(
				'key'               => 'field_638c863653019',
				'label'             => 'Images',
				'name'              => 'images',
				'aria-label'        => '',
				'type'              => 'gallery',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'return_format'     => 'id',
				'library'           => 'uploadedTo',
				'min'               => '',
				'max'               => '',
				'min_width'         => '',
				'min_height'        => '',
				'min_size'          => '',
				'max_width'         => '',
				'max_height'        => '',
				'max_size'          => '',
				'mime_types'        => '',
				'insert'            => 'append',
				'preview_size'      => 'medium',
			),
			array(
				'key'               => 'field_640f3e255cdc7',
				'label'             => '',
				'name'              => 'edit_help_text',
				'aria-label'        => '',
				'type'              => 'true_false',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '15',
					'class' => '',
					'id'    => '',
				),
				'message'           => 'Edit help text',
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
			array(
				'key'               => 'field_640f3cc0cb274',
				'label'             => 'Help Text',
				'name'              => 'help_text_gallery',
				'aria-label'        => '',
				'type'              => 'textarea',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_63974fe0e18e1',
							'operator' => '==',
							'value'    => 'gallery',
						),
						array(
							'field'    => 'field_640f3e255cdc7',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
				'wrapper'           => array(
					'width' => '85',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => 'Click on any image thumbnail to access the full image and see image-specific details.',
				'maxlength'         => '',
				'rows'              => 3,
				'placeholder'       => '',
				'new_lines'         => '',
			),
			array(
				'key'               => 'field_640f3dc639684',
				'label'             => 'Help Text',
				'name'              => 'help_text_rotation',
				'aria-label'        => '',
				'type'              => 'textarea',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_63974fe0e18e1',
							'operator' => '==',
							'value'    => 'rotation',
						),
						array(
							'field'    => 'field_640f3e255cdc7',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
				'wrapper'           => array(
					'width' => '85',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => 'This viewer allows you to rotate the image around a vertical or horizontal axis. To use this image viewer, you’ll need a mouse or track pad. With a trackpad: click and drag your cursor along the desired axis of rotation. Depending on the image, rotation may only be available around one axis. To zoom in and out, use two fingers to swipe up and down or reference your device’s zoom settings.',
				'maxlength'         => '',
				'rows'              => 3,
				'placeholder'       => '',
				'new_lines'         => '',
			),
			array(
				'key'               => 'field_640f3dee39685',
				'label'             => 'Help Text',
				'name'              => 'help_text_depth',
				'aria-label'        => '',
				'type'              => 'textarea',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_63974fe0e18e1',
							'operator' => '==',
							'value'    => 'depth',
						),
						array(
							'field'    => 'field_640f3e255cdc7',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
				'wrapper'           => array(
					'width' => '85',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => 'This viewer emulates a DICOM-style image format. To use this image viewer, you’ll need a mouse or track pad. With a trackpad: to increase or decrease the depth of your view, click or touch and drag your cursor up and down vertically. To zoom in and out, use two fingers to swipe up and down or reference your device’s zoom settings.',
				'maxlength'         => '',
				'rows'              => 3,
				'placeholder'       => '',
				'new_lines'         => '',
			),
			array(
				'key'               => 'field_640f3f33f3054',
				'label'             => '',
				'name'              => '',
				'aria-label'        => '',
				'type'              => 'message',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_640f3e255cdc7',
							'operator' => '!=',
							'value'    => 'yes',
						),
					),
				),
				'wrapper'           => array(
					'width' => '85',
					'class' => '',
					'id'    => '',
				),
				'message'           => '',
				'new_lines'         => 'wpautop',
				'esc_html'          => 0,
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'rad_image',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
		'show_in_rest'          => 0,
	) );
} );



