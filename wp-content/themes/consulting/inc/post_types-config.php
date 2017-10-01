<?php

$defaultPostTypesOptions = array(
    'stm_event'     => array(
        'title'        => get_theme_mod( 'post_type_events_title', esc_html__( 'Event', 'consulting' ) ),
        'plural_title' => get_theme_mod( 'post_type_events_plural', esc_html__( 'Events', 'consulting' ) ),
        'all_items'    => get_theme_mod( 'post_type_events_all_items', esc_html__( 'All Events', 'consulting' ) ),
        'rewrite'      => get_theme_mod( 'post_type_events_rewrite', 'events' ),
        'icon'         => get_theme_mod( 'post_type_events_icon', 'dashicons-calendar-alt' ),
        'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' )
    ),
    'event_member'  => array(
        'title'                 => get_theme_mod( 'post_type_events_title', esc_html__( 'Member', 'consulting' ) ),
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_menu'          => 'edit.php?post_type=stm_event',
        'supports'              => array( 'title', 'editor' )
    ),
	'stm_service'     => array(
		'title'        => get_theme_mod( 'post_type_services_title', esc_html__( 'Service', 'consulting' ) ),
		'plural_title' => get_theme_mod( 'post_type_services_plural', esc_html__( 'Services', 'consulting' ) ),
		'all_items'    => get_theme_mod( 'post_type_services_all_items', esc_html__( 'All Services', 'consulting' ) ),
		'rewrite'      => get_theme_mod( 'post_type_services_rewrite', 'services' ),
		'icon'         => get_theme_mod( 'post_type_services_icon', 'dashicons-clipboard' ),
		'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' )
	),
	'stm_careers'     => array(
		'title'        => get_theme_mod( 'post_type_careers_title', esc_html__( 'Vacancy', 'consulting' ) ),
		'plural_title' => get_theme_mod( 'post_type_careers_plural', esc_html__( 'Vacancies', 'consulting' ) ),
		'all_items'    => get_theme_mod( 'post_type_careers_all_items', esc_html__( 'All Vacancies', 'consulting' ) ),
		'rewrite'      => get_theme_mod( 'post_type_careers_rewrite', 'careers_archive' ),
		'icon'         => get_theme_mod( 'post_type_careers_icon', 'dashicons-id' ),
		'supports'     => array( 'title', 'editor' )
	),
	'stm_staff'       => array(
		'title'               => get_theme_mod( 'post_type_staff_title', esc_html__( 'Staff', 'consulting' ) ),
		'plural_title'        => get_theme_mod( 'post_type_staff_plural', esc_html__( 'Staff', 'consulting' ) ),
		'all_items'           => get_theme_mod( 'post_type_staff_all_items', esc_html__( 'All Staff', 'consulting' ) ),
		'rewrite'             => get_theme_mod( 'post_type_staff_rewrite', 'staff' ),
		'icon'                => get_theme_mod( 'post_type_careers_icon', 'dashicons-groups' ),
		'supports'            => array( 'title', 'excerpt', 'editor', 'thumbnail' )
	),
	'stm_works'       => array(
		'title'               => get_theme_mod( 'post_type_works_title', esc_html__( 'Work', 'consulting' ) ),
		'plural_title'        => get_theme_mod( 'post_type_works_plural', esc_html__( 'Works', 'consulting' ) ),
		'all_items'           => get_theme_mod( 'post_type_works_all_items', esc_html__( 'All Works', 'consulting' ) ),
		'rewrite'             => get_theme_mod( 'post_type_works_rewrite', 'works' ),
		'icon'                => get_theme_mod( 'post_type_works_icon', 'dashicons-portfolio' ),
		'supports'            => array( 'title', 'excerpt', 'editor', 'thumbnail' )
	),
	'stm_testimonials' => array(
		'title'               => get_theme_mod( 'post_type_testimonials_title', esc_html__( 'Testimonial', 'consulting' ) ),
		'plural_title'        => get_theme_mod( 'post_type_testimonials_plural', esc_html__( 'Testimonials', 'consulting' ) ),
		'all_items'           => get_theme_mod( 'post_type_testimonials_all_items', esc_html__( 'All Testimonials', 'consulting' ) ),
		'rewrite'             => get_theme_mod( 'post_type_testimonials_rewrite', 'testimonials' ),
		'icon'                => get_theme_mod( 'post_type_services_icon', 'dashicons-testimonial' ),
		'supports'            => array( 'title', 'excerpt', 'thumbnail' ),
		'exclude_from_search' => true,
		'publicly_queryable'  => false
	),
	'stm_vc_sidebar'  => array(
		'title'               => esc_html__( 'VC Sidebar', 'consulting' ),
		'plural_title'        => esc_html__( 'VC Sidebars', 'consulting' ),
		'all_items'           => esc_html__( 'All Sidebars', 'consulting' ),
		'rewrite'             => 'vc_sidebar',
		'icon'                => 'dashicons-schedule',
		'supports'            => array( 'title', 'editor' ),
		'exclude_from_search' => true,
		'publicly_queryable'  => false
	),
    'stm_portfolio'     => array(
        'title'        => get_theme_mod( 'post_type_portfolio_title', esc_html__( 'Portfolio', 'consulting' ) ),
        'plural_title' => get_theme_mod( 'post_type_portfolio_plural', esc_html__( 'Portfolio', 'consulting' ) ),
        'all_items'    => get_theme_mod( 'post_type_portfolio_all_items', esc_html__( 'All Portfolio', 'consulting' ) ),
        'rewrite'      => get_theme_mod( 'post_type_portfolio_rewrite', 'portfolio' ),
        'icon'         => get_theme_mod( 'post_type_portfolio_icon', 'dashicons-portfolio' ),
        'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' )
    ),
);

foreach ( $defaultPostTypesOptions as $post_type => $data ) {
	$args = array();

	if ( ! empty( $data['plural_title'] ) ) {
		$args['pluralTitle'] = $data['plural_title'];
	}
	if ( ! empty( $data['all_items'] ) ) {
		$args['all_items'] = $data['all_items'];
	}
	if ( ! empty( $data['icon'] ) ) {
		$args['menu_icon'] = $data['icon'];
	}
	if ( ! empty( $data['rewrite'] ) ) {
		$args['rewrite'] = array( 'slug' => $data['rewrite'] );
	}
	if ( ! empty( $data['supports'] ) ) {
		$args['supports'] = $data['supports'];
	}
	if ( ! empty( $data['exclude_from_search'] ) ) {
		$args['exclude_from_search'] = $data['exclude_from_search'];
	}
	if ( ! empty( $data['publicly_queryable'] ) ) {
		$args['publicly_queryable'] = $data['publicly_queryable'];
	}
	if ( ! empty( $data['show_in_menu'] ) ) {
		$args['show_in_menu'] = $data['show_in_menu'];
	}
	STM_PostType::registerPostType( $post_type, esc_html( $data['title'] ), $args );
}

STM_PostType::addTaxonomy( 'stm_testimonials_category', esc_html__( 'Categories', 'consulting' ), 'stm_testimonials' );
STM_PostType::addTaxonomy( 'stm_event_category', __( 'Categories', 'consulting' ), 'stm_event' );
STM_PostType::addTaxonomy( 'stm_service_category', __( 'Categories', 'consulting' ), 'stm_service' );
STM_PostType::addTaxonomy( 'stm_works_category', esc_html__( 'Categories', 'consulting' ), 'stm_works' );
STM_PostType::addTaxonomy( 'stm_staff_category', esc_html__( 'Categories', 'consulting' ), 'stm_staff' );
STM_PostType::addTaxonomy( 'stm_portfolio_category', __( 'Categories', 'consulting' ), 'stm_portfolio' );

if ( ! function_exists( 'stm_post_types_init' ) ) {
	function stm_post_types_init() {

		// Default Values
		$metabox_header_inverse = get_theme_mod( 'metabox_header_inverse', false );
		$metabox_disable_title_box = get_theme_mod( 'metabox_disable_title_box', false );
		$metabox_enable_transparent = get_theme_mod( 'metabox_enable_transparent', false );
		$metabox_title_box_title_color = get_theme_mod( 'metabox_title_box_title_color' );
		$metabox_title_box_title_line_color = get_theme_mod( 'metabox_title_box_title_line_color' );
        $metabox_title_box_title_bg_color = get_theme_mod( 'metabox_title_box_title_bg_color' );
		$metabox_title_box_bg_image = get_theme_mod( 'metabox_title_box_bg_image' );
		$metabox_title_box_bg_position = get_theme_mod( 'metabox_title_box_bg_position' );
		$metabox_title_box_bg_size = get_theme_mod( 'metabox_title_box_bg_size' );
		$metabox_title_box_bg_repeat = get_theme_mod( 'metabox_title_box_bg_repeat', 'no-repeat' );
		$metabox_disable_title = get_theme_mod( 'metabox_disable_title', false );
		$metabox_disable_breadcrumbs = get_theme_mod( 'metabox_disable_breadcrumbs', false );
		$metabox_enable_header_transparent = get_theme_mod( 'metabox_enable_header_transparent', false );
		$metabox_content_bg_transparent = get_theme_mod( 'metabox_content_bg_transparent', false );
		$metabox_footer_copyright_border_t = get_theme_mod( 'metabox_footer_copyright_border_t', false );

		STM_PostType::addMetaBox( 'page_setup', esc_html__( 'Page Setup', 'consulting' ), array( 'page', 'post', 'stm_event', 'stm_service', 'stm_careers', 'stm_staff', 'stm_works', 'stm_portfolio', 'product' ), '', '', '', array(
			'fields' => array(
				'separator_header_options' => array(
					'label' => esc_html__( 'Header Options', 'consulting' ),
					'type'  => 'separator'
				),
				'header_inverse'=> array(
					'label' => esc_html__( 'Style - Inverse', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_header_inverse
				),
				'separator_title_box_options' => array(
					'label' => esc_html__( 'Title Box Options', 'consulting' ),
					'type'  => 'separator'
				),
				'disable_title_box' => array(
					'label' => esc_html__( 'Disable Title Box', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_disable_title_box
				),
				'enable_transparent' => array(
					'label' => esc_html__( 'Enable Transparent', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_enable_transparent
				),
				'title_box_title_color' => array(
					'label' => esc_html__( 'Title Color', 'consulting' ),
					'type'  => 'color_picker',
					'default' => $metabox_title_box_title_color
				),
				'title_box_title_line_color' => array(
					'label' => esc_html__( 'Title Line Color', 'consulting' ),
					'type'  => 'color_picker',
					'default' => $metabox_title_box_title_line_color
				),
                'title_box_title_bg_color' => array(
                    'label' => esc_html__( 'Title Background Color', 'consulting' ),
                    'type'  => 'color_picker',
                    'default' => $metabox_title_box_title_bg_color
                ),
				'title_box_bg_image' => array(
					'label' => esc_html__( 'Background Image', 'consulting' ),
					'type'  => 'image',
					'default' => $metabox_title_box_bg_image
				),
				'title_box_bg_position' => array(
					'label' => esc_html__( 'Background Position', 'consulting' ),
					'type'  => 'text',
					'default' => $metabox_title_box_bg_position
				),
				'title_box_bg_size' => array(
					'label' => esc_html__( 'Background Size', 'consulting' ),
					'type'  => 'text',
					'default' => $metabox_title_box_bg_size
				),
				'title_box_bg_repeat' => array(
					'label'   => esc_html__( 'Background Repeat', 'consulting' ),
					'type'    => 'select',
					'options' => array(
						'repeat'    => esc_html__( 'Repeat', 'consulting' ),
						'no-repeat' => esc_html__( 'No Repeat', 'consulting' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'consulting' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'consulting' )
					),
					'default' => $metabox_title_box_bg_repeat
				),
				'disable_title' => array(
					'label' => esc_html__( 'Disable Title', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_disable_title
				),
				'disable_breadcrumbs' => array(
					'label' => esc_html__( 'Disable Breadcrumbs', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_disable_breadcrumbs
				),
				'enable_header_transparent' => array(
					'label' => esc_html__( 'Enable Header Transparent', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_enable_header_transparent
				),
				'separator_content_options' => array(
					'label' => esc_html__( 'Content Options', 'consulting' ),
					'type'  => 'separator'
				),
				'content_bg_transparent'=> array(
					'label' => esc_html__( 'Background - Transparent (Work only with "Boxed Mode")', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_content_bg_transparent
				),
				'separator_footer_options' => array(
					'label' => esc_html__( 'Footer Options', 'consulting' ),
					'type'  => 'separator'
				),
				'separator_footer_copyright_border_t' => array(
					'label' => esc_html__( 'Border Top - Hide', 'consulting' ),
					'type'  => 'checkbox',
					'default' => $metabox_footer_copyright_border_t
				)
			)
		) );

		$testimonials_info = array(
			'testimonial_position' => array(
				'label' => esc_html__( 'Position', 'consulting' ),
				'type'  => 'text'
			),
			'testimonial_company' => array(
				'label' => esc_html__( 'Company', 'consulting' ),
				'type'  => 'text'
			),
			'testimonial_bg_img' => array(
				'label' => esc_html__( 'Background Image', 'consulting' ),
				'type'  => 'image'
			)
		);

		if(stm_check_layout('layout_15')) {
			$testimonials_info['testimonial_video_url'] = array(
				'label' => esc_html__( 'Video url', 'consulting' ),
				'type'  => 'text'
			);
		}

		STM_PostType::addMetaBox( 'testimonials_info', esc_html__( 'Information', 'consulting' ), array( 'stm_testimonials' ), '', '', '', array(
			'fields' => $testimonials_info
		) );

		STM_PostType::addMetaBox( 'careers_information', esc_html__( 'Information', 'consulting' ), array( 'stm_careers' ), '', '', '', array(
			'fields' => array(
				'department'   => array(
					'label' => esc_html__( 'Department', 'consulting' ),
					'type'  => 'text'
				),
				'location'     => array(
					'label' => esc_html__( 'Location', 'consulting' ),
					'type'  => 'text'
				),
				'education'    => array(
					'label' => esc_html__( 'Education', 'consulting' ),
					'type'  => 'text'
				),
				'compensation' => array(
					'label' => esc_html__( 'Compensation', 'consulting' ),
					'type'  => 'text'
				),
				'contact_link' => array(
					'label' => esc_html__( 'Contact Us Link', 'consulting' ),
					'type'  => 'text'
				),
			)
		) );

		STM_PostType::addMetaBox( 'staff_information', esc_html__( 'Information', 'consulting' ), array( 'stm_staff' ), '', '', '', array(
			'fields' => array(
				'department'  => array(
					'label' => esc_html__( 'Department', 'consulting' ),
					'type'  => 'text'
				),
				'address'  => array(
					'label' => esc_html__( 'Address', 'consulting' ),
					'type'  => 'text'
				),
				'phone'       => array(
					'label' => esc_html__( 'Phone', 'consulting' ),
					'type'  => 'text'
				),
				'skype'       => array(
					'label' => esc_html__( 'Skype', 'consulting' ),
					'type'  => 'text'
				),
				'email'       => array(
					'label' => esc_html__( 'Email', 'consulting' ),
					'type'  => 'text'
				),
				'facebook'    => array(
					'label' => esc_html__( 'Facebook', 'consulting' ),
					'type'  => 'text'
				),
				'twitter'     => array(
					'label' => esc_html__( 'Twitter', 'consulting' ),
					'type'  => 'text'
				),
				'google_plus' => array(
					'label' => esc_html__( 'Google+', 'consulting' ),
					'type'  => 'text'
				),
				'linkedin'    => array(
					'label' => esc_html__( 'Linkedin', 'consulting' ),
					'type'  => 'text'
				),
			)
		) );

        $speakers = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'stm_staff'
        ));

        $speakers_data = array(
            '' => esc_html__( 'None', 'consulting' )
        );

        if( !empty( $speakers ) ) {
            foreach( $speakers as $speaker ) {
                $speakers_data[$speaker->ID] = $speaker->post_title;
            }
        }

        STM_PostType::addMetaBox( 'events_information', esc_html__( 'Information', 'consulting' ), array( 'stm_event' ), '', '', '', array(
            'fields' => array(
                'stm_event_speakers' => array(
                    'label'   => esc_html__( 'Speaker', 'consulting' ),
                    'type'    => 'multi-select',
                    'options' => $speakers_data
                ),
                'stm_event_count' => array(
                    'label'   => esc_html__( 'Max Participants:', 'consulting' ),
                    'type'    => 'text'
                ),
                'stm_event_date_start' => array(
                    'label'   => esc_html__( 'Date - Start:', 'consulting' ),
                    'type'    => 'event_datepicker'
                ),
                'stm_event_date_end' => array(
                    'label'   => esc_html__( 'Date - End:', 'consulting' ),
                    'type'    => 'event_datepicker'
                ),
                'stm_event_time_text' => array(
                    'label'   => esc_html__( 'Time - Text:', 'consulting' ),
                    'type'    => 'text'
                ),
                'stm_event_time_start' => array(
                    'label'   => esc_html__( 'Time - Start:', 'consulting' ),
                    'type'    => 'event_timepicker'
                ),
                'stm_event_time_end' => array(
                    'label'   => esc_html__( 'Time - End:', 'consulting' ),
                    'type'    => 'event_timepicker'
                ),
                'stm_event_venue' => array(
                    'label'   => esc_html__( 'Venue:', 'consulting' ),
                    'type'    => 'textarea'
                ),
                'stm_event_map_lat' => array(
                    'label'   => esc_html__( 'Latitude:', 'consulting' ),
                    'type'    => 'text'
                ),
                'stm_event_map_lng' => array(
                    'label'   => esc_html__( 'Longitude:', 'consulting' ),
                    'type'    => 'text'
                ),
                'stm_event_tel' => array(
                    'label'   => esc_html__( 'Telephone:', 'consulting' ),
                    'type'    => 'text'
                )
            )
        ) );

        STM_PostType::addMetaBox( 'event_member_contact_info', esc_html__( 'Contact Info', 'consulting' ), array( 'event_member' ), '', '', '', array(
            'fields' => array(
                'name'   => array(
                    'label' => esc_html__( 'Name', 'consulting' ),
                    'type'  => 'text'
                ),
                'email'   => array(
                    'label' => esc_html__( 'Email', 'consulting' ),
                    'type'  => 'text'
                ),
                'phone'   => array(
                    'label' => esc_html__( 'Phone', 'consulting' ),
                    'type'  => 'text'
                ),
                'company'   => array(
                    'label' => esc_html__( 'Company', 'consulting' ),
                    'type'  => 'text'
                ),
                'memberId'   => array(
                    'label' => esc_html__( 'Member ID', 'consulting' ),
                    'type'  => 'text'
                )
            )
        ) );

        STM_PostType::addMetaBox( 'portfolio_information', esc_html__( 'Portfolio image size', 'consulting' ), array( 'stm_portfolio' ), '', '', '', array(
            'fields' => array(
                'stm_portfolio_column' => array(
                    'label'   => esc_html__( 'Size', 'consulting' ),
                    'type'    => 'select',
                    'options' => array(
                        'default'    => esc_html__( 'Default', 'consulting' ),
                        'wide' => esc_html__( 'Wide', 'consulting' ),
                        'long'  => esc_html__( 'High', 'consulting' )
                    ),
                )
            )
        ) );

		STM_PostType::addMetaBox( 'service_information', esc_html__( 'Information', 'consulting' ), array( 'stm_service' ), '', '', '', array(
			'fields' => array(
				'service_label' => array(
					'label' => esc_html__( 'Label', 'consulting' ),
					'type'  => 'text'
				),
				'service_cost' => array(
					'label' => esc_html__( 'Cost', 'consulting' ),
					'type'  => 'text'
				)
			)
		) );

	}
}

add_action( 'init', 'stm_post_types_init' );