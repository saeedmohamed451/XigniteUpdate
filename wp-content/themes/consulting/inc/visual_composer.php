<?php

$consulting_config = consulting_config();

if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array(
		'page',
		'post',
		'stm_vc_sidebar',
		'stm_careers',
		'stm_service',
		'stm_staff',
		'stm_works',
        'stm_event',
        'stm_portfolio',
    ) );
}

add_action( 'vc_before_init', 'consulting_vc_set_as_theme' );

if( ! function_exists( 'consulting_vc_set_as_theme' ) ) {
	function consulting_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if ( is_admin() ) {
	if ( ! function_exists( 'consulting_vc_remove_teaser_metabox' ) ) {
		function consulting_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}

		add_action( 'do_meta_boxes', 'consulting_vc_remove_teaser_metabox' );
	}
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'stm_animator', 'consulting_animator_param' );
}

if( ! function_exists( 'consulting_animator_param' ) ){
	function consulting_animator_param( $settings, $value ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$animations = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/animate-config.json' ), true );
		if ( $animations ) {
			$output = '<select name="' . esc_attr( $param_name ) . '" class="wpb_vc_param_value ' . esc_attr( $param_name . ' ' . $type . ' ' . $class ) . '">';
			foreach ( $animations as $key => $val ) {
				if ( is_array( $val ) ) {
					$labels = str_replace( '_', ' ', $key );
					$output .= '<optgroup label="' . ucwords( esc_attr( $labels ) ) . '">';
					foreach ( $val as $label => $style ) {
						$label = str_replace( '_', ' ', $label );
						if ( $label == $value ) {
							$output .= '<option selected value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						} else {
							$output .= '<option value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						}
					}
				} else {
					if ( $key == $value ) {
						$output .= "<option selected value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					} else {
						$output .= "<option value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					}
				}
			}

			$output .= '</select>';
		}

		return $output;
	}
}

if ( ! function_exists( 'consulting_vc_google_fonts' ) ) {
	function consulting_vc_google_fonts( $fonts ) {
		$fonts[] = (object) array(
				'font_family' => 'Poppins',
				'font_styles' => '300,regular,500,600,700',
				'font_types'  => '300 light:300:normal,400 regular:400:normal,500 medium:500:normal,600 semi-bold:600:normal,700 bold:700:normal'
		);
		return $fonts;
	}
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'consulting_vc_google_fonts', 10, 1 );

add_action( 'vc_after_init', 'consulting_update_existing_shortcode' );

if ( ! function_exists( 'consulting_update_existing_shortcode' ) ) {
    function consulting_update_existing_shortcode() {
        if ( function_exists( 'vc_add_params' ) ) {
            vc_add_params('vc_column', array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Stretch column', 'consulting'),
                    'param_name' => 'stretch',
                    'value'      => array(
                        __('Default', 'consulting')                  => '',
                        __('Stretch out to the left', 'consulting')  => 'left',
                        __('Stretch out to the right', 'consulting') => 'right',
                    ),
                    'std'        => '',
                    'weight'     => 1
                )
            ));
        }
    }
}

add_action( 'admin_init', 'consulting_update_existing_shortcodes' );

if ( ! function_exists( 'consulting_update_existing_shortcodes' ) ) {
	function consulting_update_existing_shortcodes() {

		if ( function_exists( 'vc_add_params' ) ) {

			vc_add_params( 'vc_gallery', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Gallery type', 'consulting' ),
					'param_name' => 'type',
					'value'      => array(
						__( 'Image grid', 'consulting' )     => 'image_grid',
						__( 'Slick slider', 'consulting' )   => 'slick_slider',
						__( 'Slick slider 2', 'consulting' ) => 'slick_slider_2',
						__( 'Image full', 'consulting' ) => 'image_full'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Thumbnail size', 'consulting' ),
					'param_name' => 'thumbnail_size',
					'dependency' => array(
						'element' => 'type',
						'value'   => array( 'slick_slider_2' )
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			) );

            vc_add_params( 'vc_cta', array(
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Particles background', 'consulting' ),
                    'param_name' => 'particles',
                    'value'      => array(
                        esc_html__( 'Yes', 'consulting' ) => 'yes'
                    ),
                ),
            ) );

			vc_add_params( 'vc_column_inner', array(
				array(
					'type'        => 'column_offset',
					'heading'     => esc_html__( 'Responsiveness', 'consulting' ),
					'param_name'  => 'offset',
					'group'       => esc_html__( 'Width & Responsiveness', 'consulting' ),
					'description' => esc_html__( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'consulting' )
				)
			) );

			vc_add_params( 'vc_separator', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Type', 'consulting' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Type 1', 'consulting' ) => 'type_1',
						esc_html__( 'Type 2', 'consulting' ) => 'type_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				),
			) );

			vc_add_params( 'vc_video', array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Video Width', 'consulting' ),
					'param_name' => 'size'
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Video Height', 'consulting' ),
                    'param_name' => 'height_size'
                ),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Preview Image', 'consulting' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'consulting' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'consulting' )
				),
			) );

            if(stm_check_layout('layout_20')) {
                vc_add_params('vc_video', array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Button text', 'consulting'),
                        'param_name' => 'button_text',
                    ),
                ));
            }

			vc_add_params( 'vc_wp_pages', array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			) );

			vc_add_params( 'vc_custom_heading', array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'consulting' ),
					'param_name' => 'icon',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon Size (px)', 'consulting' ),
					'param_name' => 'icon_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'consulting' ),
					'param_name' => 'icon_pos',
					'value'      => array(
						esc_html__( 'Left', 'consulting' ) => '',
						esc_html__( 'Right', 'consulting' ) => 'right',
						esc_html__( 'Top', 'consulting' ) => 'top',
						esc_html__( 'Bottom', 'consulting' ) => 'bottom'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Subtitle', 'consulting' ),
					'param_name' => 'subtitle',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Subtitle - Color', 'consulting' ),
					'param_name' => 'subtitle_color',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Stripe - Position', 'consulting' ),
					'param_name' => 'stripe_pos',
					'value'      => array(
						esc_html__( 'Bottom', 'consulting' ) => 'bottom',
						esc_html__( 'Between Title and Subtitle', 'consulting' ) => 'between',
						esc_html__( 'Hide', 'consulting' ) => 'hide'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Font weight', 'consulting' ),
					'param_name' => 'stm_title_font_weight',
					'value'      => array(
						esc_html__( 'Select', 'consulting' )    => '',
						esc_html__( 'Thin', 'consulting' )      => 100,
						esc_html__( 'Light', 'consulting' )     => 300,
						esc_html__( 'Regular', 'consulting' )   => 400,
						esc_html__( 'Medium', 'consulting' )    => 500,
						esc_html__( 'Semi-bold', 'consulting' ) => 600,
						esc_html__( 'Bold', 'consulting' )      => 700,
						esc_html__( 'Black', 'consulting' )     => 900
					),
					'weight'     => 1
				)
			) );

			vc_add_params( 'vc_basic_grid', array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Gap', 'consulting' ),
					'param_name'       => 'gap',
					'value'            => array(
						esc_html__( '0px', 'consulting' )  => '0',
						esc_html__( '1px', 'consulting' )  => '1',
						esc_html__( '2px', 'consulting' )  => '2',
						esc_html__( '3px', 'consulting' )  => '3',
						esc_html__( '4px', 'consulting' )  => '4',
						esc_html__( '5px', 'consulting' )  => '5',
						esc_html__( '10px', 'consulting' ) => '10',
						esc_html__( '15px', 'consulting' ) => '15',
						esc_html__( '20px', 'consulting' ) => '20',
						esc_html__( '25px', 'consulting' ) => '25',
						esc_html__( '30px', 'consulting' ) => '30',
						esc_html__( '35px', 'consulting' ) => '35',
						esc_html__( '40px', 'consulting' ) => '40',
						esc_html__( '45px', 'consulting' ) => '45',
						esc_html__( '50px', 'consulting' ) => '50',
						esc_html__( '55px', 'consulting' ) => '55',
						esc_html__( '60px', 'consulting' ) => '60',
					),
					'std'              => '30',
					'description'      => esc_html__( 'Select gap between grid elements.', 'consulting' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				)
			) );

			vc_add_params( 'vc_btn', array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'consulting' ),
					'param_name'         => 'color',
					'description'        => esc_html__( 'Select button color.', 'consulting' ),
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value'              => array(
						                        esc_html__( 'Theme Style 1', 'consulting' )     => 'theme_style_1',
						                        esc_html__( 'Theme Style 2', 'consulting' )     => 'theme_style_2',
						                        esc_html__( 'Theme Style 3', 'consulting' )     => 'theme_style_3',
						                        esc_html__( 'Theme Style 4', 'consulting' )     => 'theme_style_4',
						                        esc_html__( 'Classic Link', 'consulting' )     => 'link',
						                        esc_html__( 'Classic Grey', 'consulting' )      => 'default',
						                        esc_html__( 'Classic Blue', 'consulting' )      => 'primary',
						                        esc_html__( 'Classic Turquoise', 'consulting' ) => 'info',
						                        esc_html__( 'Classic Green', 'consulting' )     => 'success',
						                        esc_html__( 'Classic Orange', 'consulting' )    => 'warning',
						                        esc_html__( 'Classic Red', 'consulting' )       => 'danger',
						                        esc_html__( 'Classic Black', 'consulting' )     => 'inverse',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'dependency'         => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'custom', 'outline-custom' ),
					),
				)/*,
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Sub Title', 'consulting' ),
					'param_name' => 'sub_title',
					'weight'     => 1
				)*/
			) );

		}

	}
}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'consulting_vc_elements' );
}

if ( ! function_exists( 'consulting_vc_elements' ) ) {
	function consulting_vc_elements() {

		$project_categories_array = get_terms( 'project_category' );
		$project_categories       = array(
			esc_html__( 'All', 'consulting' ) => 'all'
		);
		if ( $project_categories_array && ! is_wp_error( $project_categories_array ) ) {
			foreach ( $project_categories_array as $cat ) {
				$project_categories[ $cat->name ] = $cat->slug;
			}
		}

		$testimonial_categories_array = get_terms( 'stm_testimonials_category' );
		$testimonial_categories       = array(
			esc_html__( 'All', 'consulting' ) => 'all'
		);
		if ( $testimonial_categories_array && ! is_wp_error( $testimonial_categories_array ) ) {
			foreach ( $testimonial_categories_array as $cat ) {
				$testimonial_categories[ $cat->name ] = $cat->slug;
			}
		}

        $staff_categories_array = get_terms( 'stm_staff_category' );
        $staff_categories       = array(
            esc_html__( 'All', 'consulting' ) => 'all'
        );
        if ( $staff_categories_array && ! is_wp_error( $staff_categories_array ) ) {
            foreach ( $staff_categories_array as $cat ) {
                $staff_categories[ $cat->name ] = $cat->slug;
            }
        }

        $event_categories_array = get_terms( 'stm_event_category' );
        $event_categories       = array(
            esc_html__( 'All', 'consulting' ) => 'all'
        );
        if ( $event_categories_array && ! is_wp_error( $event_categories_array ) ) {
            foreach ( $event_categories_array as $cat ) {
                $event_categories[ $cat->name ] = $cat->slug;
            }
        }

        $portfolio_categories_array = get_terms( 'stm_portfolio_category' );
        $portfolio_categories       = array(
            esc_html__( 'All', 'consulting' ) => 'all'
        );
        if ( $portfolio_categories_array && ! is_wp_error( $portfolio_categories_array ) ) {
            foreach ( $portfolio_categories_array as $cat ) {
                $portfolio_categories[ $cat->name ] = $cat->slug;
            }
        }

		vc_map( array(
			'name'                    => esc_html__( 'Company History', 'consulting' ),
			'base'                    => 'stm_company_history',
			'as_parent'               => array( 'only' => 'stm_company_history_item' ),
			'show_settings_on_create' => false,
			'category'                => esc_html__( 'STM', 'consulting' ),
			'params'                  => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'consulting' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			),
			'js_view'                 => 'VcColumnView'
		) );

		vc_map( array(
			'name'     => esc_html__( 'Item', 'consulting' ),
			'base'     => 'stm_company_history_item',
			'as_child' => array( 'only' => 'stm_company_history' ),
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Year', 'consulting' ),
					'param_name' => 'year'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'consulting' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'consulting' ),
					'param_name' => 'description'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Our Partner', 'consulting' ),
			'base'     => 'stm_partner',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'consulting' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'consulting' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting' ) => 'style_2'
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'consulting' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Logo', 'consulting' ),
					'param_name' => 'logo'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Position', 'consulting' ),
					'param_name' => 'position',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_2' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'consulting' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "default" size.', 'consulting' )
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'consulting' ),
					'param_name' => 'description'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'consulting' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Contacts', 'consulting' ),
			'base'     => 'stm_contacts_widget',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'consulting' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'consulting' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting' ) => 'style_3',
						esc_html__( 'Style 4', 'consulting' ) => 'style_4'
					),
				),
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'consulting' ),
					'param_name' => 'title',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_4'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Address', 'consulting' ),
					'param_name' => 'address',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_3', 'style_4'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Phone', 'consulting' ),
					'param_name' => 'phone',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_2', 'style_4'))
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Phone Two', 'consulting' ),
                    'param_name' => 'phone_two',
                    'dependency' => array('element' => 'style', 'value' => array('style_4'))
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Fax', 'consulting' ),
                    'param_name' => 'fax',
                    'dependency' => array('element' => 'style', 'value' => array('style_4'))
                ),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Phone', 'consulting' ),
					'param_name' => 'phones',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'consulting' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Schedule', 'consulting' ),
					'param_name' => 'schedule',
					'dependency' => array('element' => 'style', 'value' => array('style_3', 'style_4'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Facebook', 'consulting' ),
					'param_name' => 'facebook',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_4'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Twitter', 'consulting' ),
					'param_name' => 'twitter',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_4'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Linkedin', 'consulting' ),
					'param_name' => 'linkedin',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_4'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Google+', 'consulting' ),
					'param_name' => 'google_plus',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_4'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'consulting' ),
					'param_name' => 'skype',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_4'))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'consulting' ),
					'param_name'  => 'class',
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'consulting' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		$stm_info_box = array(
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Title', 'consulting' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Image', 'consulting' ),
				'param_name' => 'image',
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Image Size', 'consulting' ),
				'param_name' => 'vc_image_size',
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
				),
				'description' => esc_html__( 'Example: Text - full, large, medium, Number - 340x200', 'consulting' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Align Center', 'consulting' ),
				'param_name' => 'align_center',
				'value'      => array(
					esc_html__( 'Yes', 'consulting' ) => 'yes'
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'consulting' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Style 1', 'consulting' ) => 'style_1',
					esc_html__( 'Style 2', 'consulting' ) => 'style_2',
					esc_html__( 'Style 3', 'consulting' ) => 'style_3',
					esc_html__( 'Style 4', 'consulting' ) => 'style_4',
					esc_html__( 'Style 5', 'consulting' ) => 'style_5',
					esc_html__( 'Style 6', 'consulting' ) => 'style_6'
				),
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Title Icon', 'consulting' ),
				'param_name' => 'title_icon',
				'value'      => '',
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style_3', 'style_6' )
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Icon - Size', 'consulting' ),
				'param_name' => 'title_icon_size',
				'description' => esc_html__( 'Enter icon size in "px"', 'consulting'),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style_6' )
				)
			),
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__( 'Text', 'consulting' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__( 'Link', 'consulting' ),
				'param_name' => 'link'
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Link Icon', 'consulting' ),
				'param_name' => 'icon',
				'value'      => '',
				'dependency'  => array(
					'element' => 'style',
					'value'   => array( 'style_1', 'style_2', 'style_3', 'style_5', 'style_6' )
				)
			),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', 'consulting' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design options', 'consulting' )
			)
		);

		if(stm_check_layout('layout_15')) {
			$stm_info_box[] = array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__( 'Icon', 'consulting' ),
				'param_name' => 'icon_l15',
				'value'      => '',
			);
		}

		vc_map( array(
			'name'     => esc_html__( 'Info Box', 'consulting' ),
			'base'     => 'stm_info_box',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => $stm_info_box
		) );

		vc_map( array(
			'name'     => esc_html__( 'Icon Box', 'consulting' ),
			'base'     => 'stm_icon_box',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'consulting' ),
					'param_name' => 'box_style',
					'value'      => array(
						esc_html__( 'Style 1', 'consulting' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting' ) => 'style_3',
						esc_html__( 'Style 4', 'consulting' ) => 'style_4'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Alignment', 'consulting' ),
					'param_name' => 'alignment',
					'value'      => array(
						esc_html__( 'Left', 'consulting' )   => 'left',
						esc_html__( 'Right', 'consulting' )  => 'right',
						esc_html__( 'Center', 'consulting' ) => 'center'
					),
					'dependency' => array('element' => 'box_style', 'value' => array('style_2', 'style_4'))
				),
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'consulting' ),
					'param_name' => 'title',
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1', 'style_2', 'style_4'))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Font size', 'consulting' ),
					'param_name'  => 'title_font_size',
					'description' => esc_html__( 'Enter font size in px', 'consulting' ),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Line Height', 'consulting' ),
					'param_name'  => 'title_line_height',
					'description' => esc_html__( 'Enter line-height in px', 'consulting' ),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'consulting' ),
					'param_name' => 'title_color',
					'value'      => array(
						esc_html__( 'Base', 'consulting' ) => 'base',
						esc_html__( 'Secondary', 'consulting' ) => 'secondary',
						esc_html__( 'Third', 'consulting' ) => 'third',
						esc_html__( 'Custom', 'consulting' ) => 'custom'
					),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'consulting' ),
					'param_name' => 'title_color_custom',
					'dependency' => array('element' => 'title_color', 'value' => 'custom')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'hide_title_line',
					'value'      => array(
						esc_html__( 'Hide Title Line', 'consulting' ) => 'hide_title_line'
					),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon',
					'value'      => array(
						esc_html__( 'Enable Hexagon', 'consulting' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon_animation',
					'value'      => array(
						esc_html__( 'Enable Hexagon Hover Animation', 'consulting' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'v_align_middle',
					'value'      => array(
						esc_html__( 'Vertical Middle Align', 'consulting' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
                array(
                    'type'       => 'checkbox',
                    'heading'    => '',
                    'param_name' => 'add_link',
                    'value'      => array(
                        esc_html__( 'Add link', 'consulting' ) => 'enable'
                    )
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Button link', 'consulting' ),
                    'param_name' => 'link',
                    'dependency' => array( 'element' => 'add_link', 'value' => 'enable' )
                ),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'consulting' ),
					'param_name' => 'icon',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'consulting' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Icon Top', 'consulting' )              => 'icon_top',
						esc_html__( 'Icon Top Transparent', 'consulting' ) => 'icon_top_transparent',
						esc_html__( 'Icon Left', 'consulting' )             => 'icon_left',
						esc_html__( 'Icon Left Transparent', 'consulting' ) => 'icon_left_transparent'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Size', 'consulting' ),
					'param_name'  => 'icon_size',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon size in px', 'consulting' )
				),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Icon - Line Height', 'consulting' ),
                    'param_name'  => 'icon_line_height',
                    'description' => esc_html__( 'Enter line-height in px', 'consulting' ),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_3', 'style_4'))
                ),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'consulting' ),
					'param_name' => 'icon_color',
					'value'      => array(
						esc_html__( 'Default', 'consulting' ) => 'default',
						esc_html__( 'Base', 'consulting' ) => 'base',
						esc_html__( 'Secondary', 'consulting' ) => 'secondary',
						esc_html__( 'Third', 'consulting' ) => 'third',
						esc_html__( 'Custom', 'consulting' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'consulting' ),
					'param_name' => 'icon_color_custom',
					'dependency' => array('element' => 'icon_color', 'value' => 'custom')
				),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Icon - Background Color', 'consulting' ),
                    'param_name' => 'icon_bg_color',
                    'value'      => array(
                        esc_html__( 'Base', 'consulting' ) => 'base_bg',
                        esc_html__( 'Secondary', 'consulting' ) => 'secondary_bg',
                        esc_html__( 'Third', 'consulting' ) => 'third_bg',
                        esc_html__( 'Custom', 'consulting' ) => 'custom'
                    ),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1'))
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Icon - Color Custom', 'consulting' ),
                    'param_name' => 'icon_bg_color_custom',
                    'dependency' => array('element' => 'icon_bg_color', 'value' => 'custom')
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Icon - Border Color', 'consulting' ),
                    'param_name' => 'icon_border_color',
                    'value'      => array(
                        esc_html__( 'Base', 'consulting' ) => 'base',
                        esc_html__( 'Secondary', 'consulting' ) => 'secondary',
                        esc_html__( 'Third', 'consulting' ) => 'third',
                        esc_html__( 'Custom', 'consulting' ) => 'custom'
                    ),
                    'dependency' => array('element' => 'box_style', 'value' => array('style_3'))
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Icon - Border Custom', 'consulting' ),
                    'param_name' => 'icon_border_color_custom',
                    'dependency' => array('element' => 'icon_border_color', 'value' => 'custom')
                ),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Height', 'consulting' ),
					'param_name'  => 'icon_height',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon height in px', 'consulting' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_top', 'icon_top_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Width', 'consulting' ),
					'param_name'  => 'icon_width',
					'value'       => '50',
					'description' => esc_html__( 'Enter icon width in px', 'consulting' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_left', 'icon_left_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Wrapper Width', 'consulting' ),
					'param_name'  => 'icon_width_wr',
					'value'       => '',
					'description' => esc_html__( 'Enter icon wrapper width in px', 'consulting' ),
					'dependency'  => array(
						'element' => 'box_style',
						'value'   => array( 'style_2' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'consulting' ),
					'param_name' => 'content',
                    'dependency' => array('element' => 'box_style', 'value' => array('style_1', 'style_3', 'style_4'))
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		$vc_stat_counter = array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Style', 'consulting' ),
                'param_name' => 'stat_counter_style',
                'value'      => array(
                    esc_html__( 'Style 1', 'consulting' ) => 'style_1',
                    esc_html__( 'Style 2', 'consulting' ) => 'style_2',
                    esc_html__( 'Style 3', 'consulting' ) => 'style_3'
                ),
            ),
			array(
				'type'       => 'textfield',
				'holder'     => 'div',
				'heading'    => esc_html__( 'Title', 'consulting' ),
				'param_name' => 'title',
                'dependency' => array( 'element' => 'stat_counter_style', 'value' => array('style_1', 'style_3') )
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Counter Value', 'consulting' ),
				'param_name' => 'counter_value',
				'value'      => '1000'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Counter Value Prefix', 'consulting' ),
				'param_name' => 'counter_value_pre',
				'value'      => ''
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Counter Value Suffix', 'consulting' ),
				'param_name' => 'counter_value_suf',
				'value'      => ''
			),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__( 'Description', 'consulting' ),
                'param_name' => 'description',
                'weight'     => 1,
                'dependency' => array( 'element' => 'stat_counter_style', 'value' => array('style_2', 'style_3') )
            ),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Duration', 'consulting' ),
				'param_name' => 'duration',
				'value'      => '2.5'
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Alignment', 'consulting' ),
                'param_name' => 'alignment',
                'value'      => array(
                    esc_html__( 'Left', 'consulting' )   => 'left',
                    esc_html__( 'Right', 'consulting' )  => 'right',
                    esc_html__( 'Center', 'consulting' ) => 'center'
                )
            ),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', 'consulting' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design options', 'consulting' )
			)
		);

		if(stm_check_layout('layout_16')) {
			$vc_stat_counter[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'consulting' ),
				'param_name' => 'stats_style',
				'value'      => array(
					esc_html__( 'Style 1', 'consulting' ) => 'style_1',
					esc_html__( 'Style 2', 'consulting' ) => 'style_2'
				),
			);
			$vc_stat_counter[] = array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Color', 'consulting' ),
				'param_name' => 'color',
				'dependency' => array( 'element' => 'stats_style', 'value' => array('style_2') )
			);
		}

		vc_map( array(
			'name'     => esc_html__( 'Stats Counter', 'consulting' ),
			'base'     => 'stm_stats_counter',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => $vc_stat_counter
		) );

		vc_map( array(
			'name'     => esc_html__( 'Testimonials', 'consulting' ),
			'base'     => 'stm_testimonials',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Count', 'consulting' ),
					'param_name' => 'count',
					'value'      => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Testimonials Per Row', 'consulting' ),
					'param_name' => 'per_row',
					'value'      => array(
						1 => 1,
						2 => 2,
						3 => 3,
					),
					'dependency' => array( 'element' => 'style', 'value' => array('style_1', 'style_2') )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'consulting' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'consulting' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting' ) => 'style_3'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Category', 'consulting' ),
					'param_name' => 'category',
					'value'      => $testimonial_categories
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Navigation', 'consulting' ),
					'param_name' => 'navigation_type',
					'value'      => array(
						esc_html__( 'Arrows', 'consulting' ) => 'arrows',
						esc_html__( 'Bullets', 'consulting' ) => 'bullets'
					)
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Slider autoplay', 'consulting' ),
					'param_name'  => 'autoplay',
					'description' => esc_html__( 'Enable autoplay mode.', 'consulting' ),
					'value'       => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
					'dependency' => array( 'element' => 'style', 'value' => 'style_3' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Autoplay Timeout', 'consulting' ),
					'param_name'  => 'timeout',
					'value'       => '5000',
					'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'consulting' ),
					'dependency'  => array(
						'element' => 'autoplay',
						'value'   => array( 'yes' ),
					),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Slider loop', 'consulting' ),
					'param_name'  => 'loop',
					'description' => esc_html__( 'Enable slider loop mode.', 'consulting' ),
					'value'       => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
					'dependency' => array( 'element' => 'style', 'value' => 'style_3' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Smart Speed', 'consulting' ),
					'param_name' => 'smart_speed',
					'value'      => '250',
					'group'      => esc_html__( 'Carousel', 'consulting' ),
					'dependency' => array( 'element' => 'style', 'value' => 'style_3' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		vc_map( array(
			'name'        => esc_html__( 'Spacing', 'consulting' ),
			'base'        => 'stm_spacing',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Large Screen', 'consulting' ),
					'param_name' => 'lg_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Medium Screen', 'consulting' ),
					'param_name' => 'md_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Small Screen', 'consulting' ),
					'param_name' => 'sm_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra Small Screen', 'consulting' ),
					'param_name' => 'xs_spacing'
				)
			)
		) );

        vc_map( array(
            'name'        => esc_html__( 'Quote', 'consulting' ),
            'base'        => 'stm_quote',
            'category' => esc_html__( 'STM', 'consulting' ),
            'params'      => array(
                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__( 'Quote', 'consulting' ),
                    'param_name' => 'quote'
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Author Image', 'consulting' ),
                    'param_name' => 'image'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Author Name', 'consulting' ),
                    'param_name'  => 'author_name'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Author Status', 'consulting' ),
                    'param_name'  => 'author_status'
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Box Color', 'consulting' ),
                    'param_name' => 'box_color',
                    'value'      => array(
                        esc_html__( 'Base', 'consulting' ) => 'base',
                        esc_html__( 'Secondary', 'consulting' ) => 'secondary',
                        esc_html__( 'Third', 'consulting' ) => 'third',
                        esc_html__( 'Custom', 'consulting' ) => 'custom'
                    )
                ),
                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Title - Color Custom', 'consulting' ),
                    'param_name' => 'box_color_custom',
                    'dependency' => array('element' => 'box_color', 'value' => 'custom')
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

		vc_map( array(
			'name'     => esc_html__( 'Testimonials Carousel', 'consulting' ),
			'base'     => 'stm_testimonials_carousel',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'consulting' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'consulting' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting' ) => 'style_3'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Category', 'consulting' ),
					'param_name' => 'category',
					'value'      => $testimonial_categories
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Count', 'consulting' ),
					'param_name' => 'count',
					'value'      => 2
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Photo - Size', 'consulting' ),
					'param_name' => 'thumb_size',
					'description' => esc_html__( 'Enter photo size 350x250', 'consulting' ),
					'value'      => '',
					'dependency' => array( 'element' => 'style', 'value' => 'style_1' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Testimonials Per Row', 'consulting' ),
					'param_name' => 'per_row',
					'value'      => array(
						1 => 1,
						2 => 2,
						3 => 3,
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Carousel autoplay', 'consulting' ),
					'param_name' => 'autoplay_carousel',
					'value'      => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Disable Carousel', 'consulting' ),
					'param_name' => 'disable_carousel',
					'value'      => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Carousel Arrows', 'consulting' ),
					'param_name' => 'disable_carousel_arrows',
					'value'      => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					)
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'consulting' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		if(stm_check_layout('layout_17')) {
			vc_map( array(
				'name'     => esc_html__( 'Testimonials Pager', 'consulting' ),
				'base'     => 'stm_testimonials_pager',
				'category' => esc_html__( 'STM', 'consulting' ),
				'params'   => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Category', 'consulting' ),
						'param_name' => 'category',
						'value'      => $testimonial_categories
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Count', 'consulting' ),
						'param_name' => 'count',
						'value'      => array(
							3 => 3,
							4 => 4,
						)
					),
					array(
						'type'       => 'css_editor',
						'heading'    => esc_html__( 'Css', 'consulting' ),
						'param_name' => 'css',
						'group'      => esc_html__( 'Design options', 'consulting' )
					)
				)
			) );
		}

		vc_map( array(
			'name'     => esc_html__( 'Contact', 'consulting' ),
			'base'     => 'stm_contact',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'consulting' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'consulting' ) => 'style_1',
                        esc_html__( 'Style 2', 'consulting' ) => 'style_2'
                    ),
                ),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Name', 'consulting' ),
					'param_name' => 'name'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'consulting' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'consulting' ),
					'param_name'  => 'image_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "default" size.', 'consulting' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Job', 'consulting' ),
					'param_name' => 'job'
				),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Phone', 'consulting' ),
                    'param_name' => 'phone',
                    'dependency' => array('element' => 'style', 'value' => array('style_2'))
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Phone Two', 'consulting' ),
                    'param_name' => 'phone_two',
                    'dependency' => array('element' => 'style', 'value' => array('style_2'))
                ),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'consulting' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'consulting' ),
					'param_name' => 'skype'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		$stm_sidebars_array = get_posts( array( 'post_type' => 'stm_vc_sidebar', 'posts_per_page' => - 1 ) );
		$stm_sidebars       = array( esc_html__( 'Select', 'consulting' ) => 0 );
		if ( $stm_sidebars_array && ! is_wp_error( $stm_sidebars_array ) ) {
			foreach ( $stm_sidebars_array as $val ) {
				$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'STM Sidebar', 'consulting' ),
			'base'     => 'stm_sidebar',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Code', 'consulting' ),
					'param_name' => 'sidebar',
					'value'      => $stm_sidebars
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		vc_map( array(
			"name"      => esc_html__( 'Animation Block', 'consulting' ),
			"base"      => 'stm_animation_block',
			"class"     => 'animation_block',
			"as_parent" => array( 'except' => 'stm_animation_block' ),
			"category"  => esc_html__( 'STM', 'consulting' ),
			"params"    => array(
				array(
					"type"       => "stm_animator",
					"class"      => "",
					"heading"    => esc_html__( "Animation", 'consulting' ),
					"param_name" => "animation",
					"value"      => ""
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Animation Duration (s)", 'consulting' ),
					"param_name"  => "animation_duration",
					"value"       => 3,
					"description" => esc_html__( "How long the animation effect should last. Decides the speed of effect.", 'consulting' ),
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Animation Delay (s)", 'consulting' ),
					"param_name"  => "animation_delay",
					"value"       => 0,
					"description" => esc_html__( "Delays the animation effect for seconds you enter above.", 'consulting' ),
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Viewport Position (%)", 'consulting' ),
					"param_name"  => "viewport_position",
					"value"       => "90",
					"description" => esc_html__( "The area of screen from top where animation effects will start working.", 'consulting' ),
				)
			),
			"js_view"   => 'VcColumnView'
		) );

		vc_map( array(
			'name'     => esc_html__( 'Image Carousel', 'consulting' ),
			'base'     => 'stm_image_carousel',
			'icon'     => 'stm_image_carousel',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'attach_images',
					'heading'    => esc_html__( 'Images', 'consulting' ),
					'param_name' => 'images'
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Enable Opacity', 'consulting' ),
					'param_name' => 'grayscale',
					'value'      => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					)
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Centered Items', 'consulting' ),
					'param_name' => 'h_centered',
					'value'      => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					)
				),
				array(
					'type' => 'exploded_textarea_safe',
					'heading' => __( 'Custom links', 'js_composer' ),
					'param_name' => 'custom_links',
					'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'js_composer' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image size', 'consulting' ),
					'param_name'  => 'img_size',
					'value'       => 'thumbnail',
					'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'consulting' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'consulting' )
				),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'consulting' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'consulting' ) => 'style_1',
                        esc_html__( 'Style 2', 'consulting' ) => 'style_2'
                    ),
                    'group'       => esc_html__( 'Carousel', 'consulting' )
                ),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Slider autoplay', 'consulting' ),
					'param_name'  => 'autoplay',
					'description' => esc_html__( 'Enable autoplay mode.', 'consulting' ),
					'value'       => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					),
					'group'       => esc_html__( 'Carousel', 'consulting' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Autoplay Timeout', 'consulting' ),
					'param_name'  => 'timeout',
					'value'       => '5000',
					'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'consulting' ),
					'dependency'  => array(
						'element' => 'autoplay',
						'value'   => array( 'yes' ),
					),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Slider loop', 'consulting' ),
					'param_name'  => 'loop',
					'description' => esc_html__( 'Enable slider loop mode.', 'consulting' ),
					'value'       => array(
						esc_html__( 'Yes', 'consulting' ) => 'yes'
					),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Slider navigation', 'consulting' ),
                    'param_name'  => 'nav',
                    'description' => esc_html__( 'Enable previous and next arrows.', 'consulting' ),
                    'value'       => array(
                        esc_html__( 'Yes', 'consulting' ) => 'yes'
                    ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style_2' ),
                    ),
                    'group'       => esc_html__( 'Carousel', 'consulting' ),
                ),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Smart Speed', 'consulting' ),
					'param_name' => 'smart_speed',
					'value'      => '250',
					'group'      => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Items', 'consulting' ),
					'param_name'  => 'items',
					'value'       => '6',
					'description' => esc_html__( 'The number of items you want to see on the screen.', 'consulting' ),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Items (Small Desktop)', 'consulting' ),
					'param_name'  => 'items_small_desktop',
					'value'       => '5',
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'consulting' ),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Items (Tablet)', 'consulting' ),
					'param_name'  => 'items_tablet',
					'value'       => '4',
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'consulting' ),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Items (Mobile)', 'consulting' ),
					'param_name'  => 'items_mobile',
					'value'       => '1',
					'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'consulting' ),
					'group'       => esc_html__( 'Carousel', 'consulting' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		$news_map = array(
			array(
				'type'       => 'loop',
				'heading'    => esc_html__( 'Query', 'consulting' ),
				'param_name' => 'loop',
				'value'      => 'size:4|post_type:post',
				'settings'   => array(
					'size' => array( 'hidden' => false, 'value' => 4 )
				),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Posts Per Row', 'consulting' ),
				'param_name' => 'posts_per_row',
				'value'      => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4
				),
				'std'        => 4
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'disable_preview_image',
				'value'      => array(
					esc_html__( 'Disable Preview Image', 'consulting' ) => 'disable'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Image Size', 'consulting' ),
				'param_name'  => 'img_size',
				'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', 'consulting' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design options', 'consulting' )
			)
		);

		if(stm_check_layout('layout_16')) {
			$news_map[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'consulting' ),
				'param_name' => 'style',
				'value'      => array(
					1 => 1,
					2 => 2,
				),
			);
		}

		vc_map( array(
			'name'     => esc_html__( 'News', 'consulting' ),
			'base'     => 'stm_news',
			'icon'     => 'stm_news',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => $news_map
		) );

		$consulting_config = consulting_config();

		vc_map( array(
			'name'                    => esc_html__( 'Google Map', 'consulting' ),
			'base'                    => 'stm_gmap',
			'icon'                    => 'stm_gmap',
			'as_parent'               => array( 'only' => 'stm_gmap_address' ),
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'category'                => esc_html__( 'STM', 'consulting' ),
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Map Height', 'consulting' ),
					'param_name'  => 'map_height',
					'value'       => '733px',
					'description' => esc_html__( 'Enter map height in px', 'consulting' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Map Zoom', 'consulting' ),
					'param_name' => 'map_zoom',
					'value'      => 18
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Marker Image', 'consulting' ),
					'param_name' => 'marker'
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'disable_mouse_whell',
					'value'      => array(
						esc_html__( 'Disable map zoom on mouse wheel scroll', 'consulting' ) => 'disable'
					)
				),
				array(
					'type'       => 'textarea_raw_html',
					'heading'    => esc_html__( 'Style Code', 'consulting' ),
					'param_name' => 'gmap_style',
					'group'      => esc_html__('Map Style', 'consulting')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'consulting' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'consulting' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Address', 'consulting' ),
			'base'     => 'stm_gmap_address',
			'icon'     => 'stm_gmap_address',
			'as_child' => array( 'only' => 'stm_gmap' ),
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'consulting' ),
					'admin_label' => true,
					'param_name'  => 'title'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Address', 'consulting' ),
					'param_name' => 'address'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Phone', 'consulting' ),
					'param_name' => 'phone'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'consulting' ),
					'param_name' => 'email'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Latitude', 'consulting' ),
					'param_name'  => 'lat',
					'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'consulting' ), array( 'a' => array( 'href' => array() ) ) )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Longitude', 'consulting' ),
					'param_name'  => 'lng',
					'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'consulting' ), array( 'a' => array( 'href' => array() ) ) )
				),
			)
		) );

		if($consulting_config['layout'] == 'layout_14' or $consulting_config['layout'] == 'layout_16') {
			vc_map( array(
				'name'                    => esc_html__( 'Google Map (Style 2)', 'consulting' ),
				'base'                    => 'stm_gmap_l14',
				'icon'                    => 'stm_gmap',
				'as_parent'               => array( 'only' => 'stm_gmap_address_l14' ),
				'show_settings_on_create' => true,
				'js_view'                 => 'VcColumnView',
				'category'                => esc_html__( 'STM', 'consulting' ),
				'params'                  => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Map Height', 'consulting' ),
						'param_name'  => 'map_height',
						'value'       => '100vh',
						'description' => esc_html__( 'Enter map height in px', 'consulting' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Map Title', 'consulting' ),
						'param_name'  => 'map_title',
						'description' => esc_html__( 'Enter Description', 'consulting' )
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Map Zoom', 'consulting' ),
						'param_name' => 'map_zoom',
						'value'      => 18
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__( 'Marker Image', 'consulting' ),
						'param_name' => 'marker'
					),
					array(
						'type'       => 'checkbox',
						'param_name' => 'disable_mouse_whell',
						'value'      => array(
							esc_html__( 'Disable map zoom on mouse wheel scroll', 'consulting' ) => 'disable'
						)
					),
					array(
						'type'       => 'textarea_raw_html',
						'heading'    => esc_html__( 'Style Code', 'consulting' ),
						'param_name' => 'gmap_style',
						'group'      => esc_html__( 'Map Style', 'consulting' )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Extra class name', 'consulting' ),
						'param_name'  => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'consulting' )
					),
					array(
						'type'       => 'css_editor',
						'heading'    => esc_html__( 'Css', 'consulting' ),
						'param_name' => 'css',
						'group'      => esc_html__( 'Design options', 'consulting' )
					)
				)
			) );

			vc_map( array(
				'name'     => esc_html__( 'Address', 'consulting' ),
				'base'     => 'stm_gmap_address_l14',
				'icon'     => 'stm_gmap_address',
				'as_child' => array( 'only' => 'stm_gmap_l14' ),
				'category' => esc_html__( 'STM', 'consulting' ),
				'params'   => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Title', 'consulting' ),
						'admin_label' => true,
						'param_name'  => 'title'
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__( 'Country', 'consulting' ),
						'admin_label' => true,
						'param_name' => 'country'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Latitude', 'consulting' ),
						'param_name'  => 'lat',
						'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'consulting' ), array( 'a' => array( 'href' => array() ) ) )
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Longitude', 'consulting' ),
						'param_name'  => 'lng',
						'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'consulting' ), array( 'a' => array( 'href' => array() ) ) )
					),
				)
			) );
		}

		vc_map( array(
			'name'     => esc_html__( 'Vacancies', 'consulting' ),
			'base'     => 'stm_vacancies',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css'
				)
			)
		) );

		$vc_staff = array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Category', 'consulting' ),
                'param_name' => 'category',
                'value'      => $staff_categories
            ),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'consulting' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'List', 'consulting' ) => 'list',
					esc_html__( 'Grid', 'consulting' ) => 'grid',
					esc_html__( 'Carousel', 'consulting' ) => 'carousel'
				)
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Grid View', 'consulting' ),
                'param_name' => 'grid_view',
                'value'      => array(
                    esc_html__( 'Default', 'consulting' ) => 'default',
                    esc_html__( 'Short', 'consulting' ) => 'short'
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value'   => array( 'grid' )
                )
            ),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Staff Per Row', 'consulting' ),
				'param_name' => 'per_row',
				'value'      => array(
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'grid' )
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Count', 'consulting' ),
				'param_name' => 'count',
				'value'      => 6
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Staff Per Row', 'consulting' ),
				'param_name' => 'slides_to_show',
				'value'      => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'carousel' )
				)
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Carousel - Show Arrows', 'consulting' ),
				'param_name'  => 'carousel_arrows',
				'value'       => array( esc_html__( 'Yes', 'consulting' ) => 'yes' ),
				'std'         => 'yes',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'carousel' )
				)
			),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Custom link in list', 'consulting' ),
                'param_name'  => 'show_custom_link',
                'value'       => array( esc_html__( 'Yes', 'consulting' ) => 'yes' ),
                'std'         => 'yes',
                'dependency' => array(
                    'element' => 'grid_view',
                    'value'   => array( 'short' )
                )
            ),
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__( 'Link', 'consulting' ),
                'param_name' => 'link',
                'dependency' => array( 'element' => 'show_custom_link', 'value' => 'yes' ),
                'group'      => esc_html__( 'Custom link', 'consulting' )
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__( 'Subtitle', 'consulting' ),
                'param_name' => 'link_text',
                'weight'     => 1,
                'dependency' => array( 'element' => 'show_custom_link', 'value' => 'yes' ),
                'group'      => esc_html__( 'Custom link', 'consulting' )
            ),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', 'consulting' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design options', 'consulting' )
			)
		);

		if(stm_check_layout('layout_16')) {
			$vc_staff[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'consulting' ),
				'param_name' => 'style_grid',
				'value'      => array(
					1 => 1,
					2 => 2,
				),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'grid' )
				)
			);
		}

		vc_map( array(
			'name'     => esc_html__( 'Staff List', 'consulting' ),
			'base'     => 'stm_staff_list',
			'icon'     => 'stm_staff_list',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => $vc_staff
		) );

		vc_map( array(
			'name'     => esc_html__( 'Details', 'consulting' ),
			'base'     => 'stm_post_details',
			'category' => esc_html__( 'STM Post Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Bottom Info', 'consulting' ),
			'base'     => 'stm_post_bottom',
			'category' => esc_html__( 'STM Post Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'About Author', 'consulting' ),
			'base'     => 'stm_post_about_author',
			'category' => esc_html__( 'STM Post Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Comments', 'consulting' ),
			'base'     => 'stm_post_comments',
			'category' => esc_html__( 'STM Post Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
				)
			)
		) );

        vc_map( array(
            'name'     => esc_html__( 'Events', 'consulting' ),
            'base'     => 'stm_events',
            'icon'     => 'stm_events',
            'category' => esc_html__( 'STM', 'consulting' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Filter Events', 'consulting' ),
                    'param_name' => 'events_filter',
                    'value'      => array(
                        esc_html__( 'Upcoming Events', 'consulting' ) => 'upcoming',
                        esc_html__( 'Past Events', 'consulting' )  => 'past',
                        esc_html__( 'All Events', 'consulting' )  => 'all',
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Category', 'consulting' ),
                    'param_name' => 'category',
                    'value'      => $event_categories
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'consulting' ),
                    'param_name' => 'event_style',
                    'value'      => array(
                        esc_html__( 'Grid', 'consulting' ) => 'grid',
                        esc_html__( 'Classic', 'consulting' )  => 'classic',
                        esc_html__( 'Modern', 'consulting' )  => 'modern',
                        esc_html__( 'Widget', 'consulting' )  => 'widget',
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number Posts', 'consulting' ),
                    'param_name' => 'posts_per_page',
                    'value'      => 12
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Posts Per Row', 'consulting' ),
                    'param_name' => 'posts_per_row',
                    'dependency' => array(
                        'element' => 'event_style',
                        'value'   => array( 'grid' )
                    ),
                    'value'      => array(
                        4 => 4,
                        3 => 3,
                        2 => 2,
                        1 => 1
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Image size', 'consulting' ),
                    'param_name'  => 'img_size',
                    'dependency' => array(
                        'element' => 'event_style',
                        'value'   => array( 'grid', 'classic' )
                    ),
                    'value'       => '',
                    'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting' ),
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Show Pagination', 'consulting' ),
                    'param_name' => 'pagination_enable',
                    'dependency' => array(
                        'element' => 'event_style',
                        'value'   => array( 'grid', 'classic' )
                    ),
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Show Load More Button', 'consulting' ),
                    'param_name' => 'load_more_enable',
                    'dependency' => array(
                        'element' => 'event_style',
                        'value'   => array( 'modern' )
                    ),
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

        vc_map( array(
            'name'     => esc_html__( 'Events Information', 'consulting' ),
            'base'     => 'stm_events_information',
            'icon'     => 'stm_events',
            'category' => esc_html__( 'STM Post Partials', 'consulting' ),
            'params'   => array(
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

        vc_map( array(
            'name'     => esc_html__( 'Events Form Box', 'consulting' ),
            'base'     => 'stm_events_form',
            'icon'     => 'stm_events',
            'category' => esc_html__( 'STM Post Partials', 'consulting' ),
            'params'   => array(
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

        vc_map( array(
            'name'     => esc_html__( '(STM) Event Map', 'consulting' ),
            'base'     => 'stm_events_map',
            'category' => esc_html__( 'STM Post Partials', 'consulting' ),
            'params'   => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Map - Height', 'consulting' ),
                    'param_name' => 'map_height',
                    'value'       => '290px',
                    'description' => esc_html__( 'Enter map height in px', 'consulting' )
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Map - Zoom', 'consulting' ),
                    'param_name' => 'zoom',
                    'description' => esc_html__( 'Enter map height in px', 'consulting' )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                ),
            )
        ) );
        
        vc_map( array(
            'name' => esc_html__( 'Event Lesson', 'consulting' ),
            'base' => 'stm_event_lesson',
            'category' => esc_html__( 'STM', 'consulting' ),
            "as_parent" => array( 'only' => 'stm_event_lessons' ),
            "is_container" => true,
            "content_element" => true,
            "show_settings_on_create" => false,
            'params' => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Date Format', 'consulting' ),
                    'param_name' => 'stm_event_lesson_date_format',
                    'value' => array(
                        esc_html__( date('D, F j, Y'), 'consulting' )  => 'D, F j, Y',
                        esc_html__( date('F j, Y'), 'consulting' )  => 'F j, Y',
                        esc_html__( date('Y-m-d'), 'consulting' )  => 'Y-m-d',
                        esc_html__( date('m/d/Y'), 'consulting' )  => 'm/d/Y',
                        esc_html__( date('d/m/Y'), 'consulting' )  => 'd/m/Y',
                    )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Time Format', 'consulting' ),
                    'param_name' => 'stm_event_lesson_time_format',
                    'value' => array(
                        esc_html__( date('g:i A'), 'consulting' )  => 'g:i A',
                        esc_html__( date('g:i a'), 'consulting' )  => 'g:i a',
                        esc_html__( date('H:i'), 'consulting' )  => 'H:i',
                    )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'       => esc_html__( 'Design Options', 'consulting' ),
                )
            ),
            "js_view" => 'VcColumnView'
        ) );

        $speakers = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'stm_staff'
        ));

        $speakers_data = array();

        if( !empty( $speakers ) ) {
            foreach( $speakers as $speaker ) {
                $speakers_data[] = array( 'label' => $speaker->post_title, 'value' => $speaker->ID);
            }
        }

        vc_map( array(
            "name" => esc_html__('Event Lessons', 'consulting'),
            "base" => "stm_event_lessons",
            "content_element" => true,
            "as_child" => array('only' => 'stm_event_lesson'),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title', 'consulting' ),
                    'param_name' => 'stm_event_lesson_title',
                ),
                array(
                    'type'        => 'stm_datepicker_vc',
                    'heading'     => __( 'Date', 'consulting' ),
                    'param_name'  => 'datepicker',
                    'holder'        => 'div'
                ),
                array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Lessons Info', 'consulting' ),
                    'param_name' => 'heading',
                    'value' => urlencode( json_encode( array(
                        array(
                            'label' => esc_html__( 'Field 1', 'consulting' ),
                            'value' => ''
                        ),
                        array(
                            'label' => esc_html__( 'Field 2', 'consulting' ),
                            'value' => ''
                        )
                    ) ) ),
                    'params' => array(
                        array(
                            'type'        => 'stm_timepicker_vc',
                            'heading'     => __( 'Time start', 'consulting' ),
                            'param_name'  => 'timepicker_start',
                            'holder'      => 'div'
                        ),
                        array(
                            'type'        => 'stm_timepicker_vc',
                            'heading'     => __( 'Time end', 'consulting' ),
                            'param_name'  => 'timepicker_end',
                            'holder'      => 'div'
                        ),
                        array(
                            'type'         => 'textfield',
                            'heading'      => esc_html__( 'Location', 'consulting' ),
                            'param_name'   => 'location'
                        ),
                        array(
                            'type'         => 'textfield',
                            'heading'      => esc_html__( 'Title', 'consulting' ),
                            'param_name'   => 'title'
                        ),
                        array(
                            'type'       => 'textarea',
                            'heading'    => esc_html__( 'Description', 'consulting' ),
                            'param_name' => 'description'
                        ),
                        array(
                            'type' => 'autocomplete',
                            'heading' => __( 'Select speakers', 'consulting' ),
                            'param_name' => 'lesson_speakers',
                            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'min_length' => 1,
                                'no_hide' => true,
                                'unique_values' => true,
                                'display_inline' => true,
                                'values' => $speakers_data
                            )
                        ),
                    )
                )
            )
        ) );

        vc_map( array(
            'name'        => __( 'Countdown', 'consulting' ),
            'base'        => 'stm_countdown',
            'icon'        => 'stm_countdown',
            'category'    => __( 'STM', 'consulting' ),
            'params'      => array(
                array(
                    'type' => 'stm_countdown_vc',
                    'heading' => __( 'Count to date', 'consulting' ),
                    'param_name' => 'countdown',
                    'holder' => 'div'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__( 'Description', 'consulting' ),
                    'param_name' => 'countdown_description',
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Link for download', 'consulting' ),
                    'param_name' => 'download_link',
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'consulting' )
                )
            )
        ) );

		vc_map( array(
			'name'     => esc_html__( 'Services', 'consulting' ),
			'base'     => 'stm_services',
			'icon'     => 'stm_services',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Number Posts', 'consulting' ),
					'param_name' => 'posts_per_page',
					'value'      => 12
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Posts Per Row', 'consulting' ),
					'param_name' => 'posts_per_row',
					'value'      => array(
						4 => 4,
						3 => 3,
						2 => 2,
						1 => 1
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image size', 'consulting' ),
					'param_name'  => 'img_size',
					'value'       => '',
					'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Charts', 'consulting' ),
			'base'     => 'stm_charts',
			'icon'     => 'stm_charts',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Design', 'consulting' ),
					'param_name' => 'design',
					'value'      => array(
						esc_html__( 'Line', 'consulting' )   => 'line',
						esc_html__( 'Bar', 'consulting' )    => 'bar',
						esc_html__( 'Circle', 'consulting' ) => 'circle',
						esc_html__( 'Pie', 'consulting' )    => 'pie',
					),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show legend?', 'consulting' ),
					'param_name'  => 'legend',
					'description' => esc_html__( 'If checked, chart will have legend.', 'consulting' ),
					'value'       => array( esc_html__( 'Yes', 'consulting' ) => 'yes' ),
					'std'         => 'yes',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Legend Position', 'consulting' ),
					'param_name' => 'legend_position',
					'value'      => array(
						esc_html__( 'Bottom', 'consulting' ) => 'bottom',
						esc_html__( 'Right', 'consulting' )  => 'right',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Width (px)', 'consulting' ),
					'param_name' => 'width',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Height (px)', 'consulting' ),
					'param_name' => 'height',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'X-axis values', 'consulting' ),
					'param_name' => 'x_values',
					'value'      => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'consulting' ),
					'param_name' => 'values',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'consulting' ),
							'y_values' => '10; 15; 20; 25; 27; 25; 23; 25',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'consulting' ),
							'y_values' => '25; 18; 16; 17; 20; 25; 30; 35',
							'color' => '#5472d2'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'consulting' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'consulting' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Y-axis values', 'consulting' ),
							'param_name' => 'y_values'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'consulting' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'consulting' ),
					'param_name' => 'values_circle',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'circle', 'pie' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'consulting' ),
							'value' => '40',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'consulting' ),
							'value' => '30',
							'color' => '#5472d2'
						),
						array(
							'title' => esc_html__( 'Three', 'consulting' ),
							'value' => '40',
							'color' => '#8d6dc4'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'consulting' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'consulting' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Value', 'consulting' ),
							'param_name' => 'value'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'consulting' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'consulting' )
				)
			)
		) );

        vc_map( array(
            'name'     => esc_html__( 'Portfolio', 'consulting' ),
            'base'     => 'stm_portfolio',
            'icon'     => 'stm_portfolio',
            'category' => esc_html__( 'STM', 'consulting' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Category', 'consulting' ),
                    'param_name' => 'category',
                    'value'      => $portfolio_categories
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number Posts', 'consulting' ),
                    'param_name' => 'posts_per_page',
                    'value'      => 12
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Show Load More Button', 'consulting' ),
                    'param_name' => 'load_more_enable'
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

        vc_map( array(
            'name'     => esc_html__( 'Portfolio Post Pagination', 'consulting' ),
            'base'     => 'stm_portfolio_pagination',
            'icon'     => 'stm_portfolio',
            'category' => esc_html__( 'STM Post Partials', 'consulting' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'consulting' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'consulting' ) => 'style_1',
                        esc_html__( 'Style 2', 'consulting' ) => 'style_2',
                        esc_html__( 'Style 3', 'consulting' ) => 'style_3'
                    ),
                ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => esc_html__( 'Show Button', 'consulting' ),
                    'param_name'  => 'show_button',
                    'description' => esc_html__( 'Button for link to the archive page.', 'consulting' ),
                    'value'       => array(
                        esc_html__( 'Yes', 'consulting' ) => 'yes'
                    )
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Button link', 'consulting' ),
                    'param_name' => 'link',
                    'dependency' => array( 'element' => 'show_button', 'value' => 'yes' )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

        vc_map( array(
            'name'     => esc_html__( 'Portfolio Information', 'consulting' ),
            'base'     => 'stm_portfolio_information',
            'icon'     => 'stm_portfolio',
            'category' => esc_html__( 'STM Post Partials', 'consulting' ),
            'params'   => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Client', 'consulting' ),
                    'param_name'  => 'portfolio_client',
                    'value'       => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Date', 'consulting' ),
                    'param_name'  => 'portfolio_date',
                    'value'       => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Services', 'consulting' ),
                    'param_name'  => 'portfolio_services',
                    'value'       => ''
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Website', 'consulting' ),
                    'param_name' => 'link'
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Role', 'consulting' ),
                    'param_name'  => 'portfolio_role',
                    'value'       => ''
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Facebook', 'consulting' ),
                    'param_name' => 'facebook'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Twitter', 'consulting' ),
                    'param_name' => 'twitter'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Instagram', 'consulting' ),
                    'param_name' => 'instagram'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Google+', 'consulting' ),
                    'param_name' => 'google_plus'
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Youtube', 'consulting' ),
                    'param_name' => 'youtube'
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Style', 'consulting' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'consulting' ) => 'style_1',
                        esc_html__( 'Style 2', 'consulting' ) => 'style_2'
                    ),
                    'group'      => esc_html__( 'Style settings', 'consulting' )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Posts Per Row', 'consulting' ),
                    'param_name' => 'posts_per_row',
                    'value'      => array(
                        4 => 4,
                        3 => 3,
                        2 => 2,
                        1 => 1
                    ),
                    'group'      => esc_html__( 'Style settings', 'consulting' )
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Alignment', 'consulting' ),
                    'param_name' => 'alignment',
                    'value'      => array(
                        esc_html__( 'Left', 'consulting' )   => 'left',
                        esc_html__( 'Right', 'consulting' )  => 'right',
                        esc_html__( 'Center', 'consulting' ) => 'center'
                    ),
                    'group'      => esc_html__( 'Style settings', 'consulting' )
                ),
                array(
                    'type'       => 'checkbox',
                    'heading'    => esc_html__( 'Show Title Icons', 'consulting' ),
                    'param_name' => 'show_title_icons',
                    'value'      => array(
                        esc_html__( 'Yes', 'consulting' ) => 'yes'
                    ),
                    'group'      => esc_html__( 'Style settings', 'consulting' )
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'consulting' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'consulting' )
                )
            )
        ) );

		vc_map( array(
			'name'     => esc_html__( 'About Vacancy', 'consulting' ),
			'base'     => 'stm_about_vacancy',
			'category' => esc_html__( 'STM Vacancy Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css',
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Vacancy Bottom', 'consulting' ),
			'base'     => 'stm_vacancy_bottom',
			'category' => esc_html__( 'STM Vacancy Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Staff Bottom', 'consulting' ),
			'base'     => 'stm_staff_bottom',
			'category' => esc_html__( 'STM Staff Partials', 'consulting' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'consulting' ),
					'param_name' => 'css'
				)
			)
		) );

		$works_categories = get_terms( 'stm_works_category' );
		$works_categories_arr = array();

		if( !empty( $works_categories ) && ! is_wp_error( $works_categories ) ) {
			foreach( $works_categories as $works_category ) {
				$works_categories_arr[] = array( 'label' => $works_category->name, 'value' => $works_category->slug );
			}
		}

		$stm_works = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Style', 'consulting' ),
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Grid', 'consulting' )             => 'grid',
					esc_html__( 'Grid with filter', 'consulting' ) => 'grid_with_filter'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'View Style', 'consulting' ),
				'param_name' => 'grid_style',
				'value'      => array(
					esc_html__( 'Style 1' ) => 'style_1',
					esc_html__( 'Style 2' ) => 'style_2'
				),
				'dependency' => array( 'element' => 'style', 'value' => 'grid' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'View Style', 'consulting' ),
				'param_name' => 'grid_with_filter_style',
				'value'      => array(
					esc_html__( 'Style 1' ) => 'style_1',
					esc_html__( 'Style 2' ) => 'style_2'
				),
				'dependency' => array( 'element' => 'style', 'value' => 'grid_with_filter' )
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Include Category', 'js_composer' ),
				'param_name' => 'works_categories',
				'description' => __( 'Add Category. If not added show all category', 'js_composer' ),
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true,
					'unique_values' => true,
					'display_inline' => true,
					'values' => $works_categories_arr
				),
				'dependency' => array( 'element' => 'style', 'value' => 'grid_with_filter' )
			),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Count', 'consulting' ),
                'param_name'  => 'works_count',
                'value'       => '',
                'description' => esc_html__( 'The number of items you want to see on the screen.', 'consulting' ),
                'dependency' => array( 'element' => 'style', 'value' => 'grid' )
            ),
			array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Count', 'consulting' ),
                'param_name'  => 'works_count_visible',
                'value'       => '',
                'description' => esc_html__( 'The number of items you want to see on the screen.', 'consulting' ),
                'dependency' => array( 'element' => 'style', 'value' => 'grid_with_filter' )
			),
		);

		if(stm_check_layout('layout_17')) {
			$stm_works[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Enable different grid tiles', 'consulting' ),
				'param_name' => 'cols',
				'value'      => array(
					__( 'Yes', 'consulting' ) => 'yes',
					__( 'No', 'consulting' )  => 'no',
				),
				'dependency' => array( 'element' => 'grid_style', 'value' => 'style_2' )
			);
		}

		$stm_works[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Cols', 'consulting' ),
			'param_name' => 'cols',
			'value'      => array(
				4 => 4,
				3 => 3,
				2 => 2,
				1 => 1,
			)
		);

		$stm_works[] = array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Image size', 'consulting' ),
			'param_name'  => 'img_size',
			'value'       => '',
			'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting' ),
		);

		$stm_works[] = array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'consulting' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'consulting' )
		);

		vc_map( array(
			'name'     => esc_html__( 'Our Works', 'consulting' ),
			'base'     => 'stm_works',
			'category' => esc_html__( 'STM', 'consulting' ),
			'params'   => $stm_works
		) );

		vc_map( array(
			'name'        => __( 'Services With Tabs', 'consulting' ),
			'base'        => 'stm_services_tabs',
			'category'    => __( 'STM', 'consulting' ),
			'params'      => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Items Count', 'consulting' ),
					'param_name' => 'items_count',
					'description' => __( 'The number of items you want to see on the screen.', 'consulting' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'consulting' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'consulting' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'consulting' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'consulting' )
				)
			)
		) );

		if(stm_check_layout('layout_18')) {
			vc_map( array(
				'name'        => esc_html__( 'Pricing Plan', 'consulting' ),
				'base'        => 'stm_pricing_plan',
				'category' => esc_html__( 'STM', 'consulting' ),
				'params'      => array(
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__( 'Plan pattern image', 'consulting' ),
						'param_name' => 'image'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Plan title', 'consulting' ),
						'param_name' => 'title'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Plan price', 'consulting' ),
						'param_name' => 'price'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Plan price affix', 'consulting' ),
						'param_name' => 'price_affix'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Plan subtitle', 'consulting' ),
						'param_name' => 'subtitle'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Plan label', 'consulting' ),
						'param_name' => 'label'
					),
					array(
						'type'       => 'textarea_html',
						'heading'    => esc_html__( 'Features', 'consulting' ),
						'param_name' => 'features',
						'weight'     => 1
					),
					array(
						'type'       => 'vc_link',
						'heading'    => esc_html__( 'Link', 'consulting' ),
						'param_name' => 'link'
					),
				)
			) );
		}

	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Stm_Company_History extends WPBakeryShortCodesContainer {
	}

    class WPBakeryShortCode_Stm_Event_Lesson extends WPBakeryShortCodesContainer {
    }

	class WPBakeryShortCode_Stm_Animation_Block extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_Stm_Gmap extends WPBakeryShortCodesContainer {
	}
	if($consulting_config['layout'] == 'layout_14' or $consulting_config['layout'] == 'layout_16') {
		class WPBakeryShortCode_Stm_Gmap_L14 extends WPBakeryShortCodesContainer {
		}
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Company_History_Item extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Partner extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Contacts_Widget extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Info_Box extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Posts extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Stats_Counter extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Contact extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Testimonials_Carousel extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Image_Carousel extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_News extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Gmap_Address extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Vacancies extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Staff_List extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Details extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Bottom extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_About_Author extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Events_Information extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Events_Form extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Events extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Events_Map extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Event_Lessons extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Services extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Charts extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Portfolio extends WPBakeryShortCode {
    }

    class WPBakeryShortCode_Stm_Portfolio_Pagination extends WPBakeryShortCode {
    }

    class WPBakeryShortCode_Stm_Portfolio_Information extends WPBakeryShortCode {
    }

    class WPBakeryShortCode_Stm_About_Vacancy extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Vacancy_Bottom extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Staff_Bottom extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Works extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Countdown extends WPBakeryShortCode {
    }

	class WPBakeryShortCode_Stm_Services_Tabs extends WPBakeryShortCode {
	}

    class WPBakeryShortCode_Stm_Quote extends WPBakeryShortCode {
    }

	class WPBakeryShortCode_Stm_Spacing extends WPBakeryShortCode {
	}
	if($consulting_config['layout'] == 'layout_14' or $consulting_config['layout'] == 'layout_16') {
		class WPBakeryShortCode_Stm_Gmap_Address_L14 extends WPBakeryShortCode {
		}
	}
	if(stm_check_layout('layout_17')) {
		class WPBakeryShortCode_Stm_Testimonials_Pager extends WPBakeryShortCode {
		}
	}
	if(stm_check_layout('layout_18')) {
		class WPBakeryShortCode_Stm_Pricing_Plan extends WPBakeryShortCode {
		}
	}
}

add_filter( 'vc_iconpicker-type-fontawesome', 'consulting_vc_icons' );

if ( ! function_exists( 'consulting_vc_icons' ) ) {
	function consulting_vc_icons( $fonts ) {

		$custom_fonts = get_option( 'stm_fonts' );
		foreach ( $custom_fonts as $font => $info ) {
			$icon_set   = array();
			$icons      = array();
			$upload_dir = wp_upload_dir();
			$path       = trailingslashit( $upload_dir['basedir'] );
			$file       = $path . $info['include'] . '/' . $info['config'];
			include( $file );
			if ( ! empty( $icons ) ) {
				$icon_set = array_merge( $icon_set, $icons );
			}
			if ( ! empty( $icon_set ) ) {
				foreach ( $icon_set as $icons ) {
					foreach ( $icons as $icon ) {
						$fonts['Theme Icons'][] = array(
							$font . '-' . $icon['class'] => $icon['class']
						);
					}
				}
			}
		}

		return $fonts;
	}
}

vc_add_shortcode_param( 'stm_datepicker_vc', 'stm_datepicker_vc_st', get_template_directory_uri().'/assets/js/jquery.stmdatetimepicker.js' );
function stm_datepicker_vc_st( $settings, $value ) {
    return '<div class="stm_datepicker_vc_field">'
    .'<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="stm_datepicker_vc wpb_vc_param_value wpb-textinput ' .
    esc_attr( $settings['param_name'] ) . ' ' .
    esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
    '</div>';
}

vc_add_shortcode_param( 'stm_timepicker_vc', 'stm_timepicker_vc_st' );
function stm_timepicker_vc_st( $settings, $value ) {
    return '<div class="stm_timepicker_vc_field">'
    .'<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="stm_timepicker_vc wpb_vc_param_value wpb-textinput ' .
    esc_attr( $settings['param_name'] ) . ' ' .
    esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
    '</div>';
}

vc_add_shortcode_param( 'stm_countdown_vc', 'stm_countdown_vc_st', get_template_directory_uri().'/assets/js/jquery.stmdatetimepicker.js' );
function stm_countdown_vc_st( $settings, $value ) {
    return '<div class="stm_countdown_vc_field">'
    .'<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="stm_countdown_vc wpb_vc_param_value wpb-textinput ' .
    esc_attr( $settings['param_name'] ) . ' ' .
    esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
    '</div>';
}

